<?php

namespace App\Http\Controllers;

use Auth;
use Log;

use App\Txns2;
use Illuminate\Http\Request;


class CSV extends Controller
{
    public static $TOTALS__PROCEEDS = 0.00;
    public static $TOTALS__COSTBASIS = 0.00;
    public static $TOTALS__GAINLOSS = 0.00;
    protected static $DID_HEADER_ROW = false;
    public static $csvHandle = null;

    public function list()
    {
        $availableYears = [2017, 2018, 2019];
        return view('csv/overview', [
            'availableYears' => $availableYears,
        ]);
    }

    public function download(Request $r)
    {
        $user = Auth::user();
        $year = (int) $r->input('year');
        $filename = sprintf('%s-HeleumTransactionReport-%s.csv', $year, $user->uphold_username);

        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Expires: 0");

        self::$csvHandle = fopen('php://output', 'w');
        $balloons = [];

        Txns2::select(
                "user_balloon_id","move_number","transaction_timestamp",
                "origin_currency","origin_amount","dest_currency","dest_amount",
                "launch_currency","latest_amount_in_base","heleum_user"
            )
            ->where('heleum_user', $user->user_id)
            ->whereBetween('transaction_timestamp', [
                sprintf('%s-01-01 00:00:00', $year),
                sprintf('%s-12-31 23:59:59', $year)
            ])
            ->where('move_number', '>', 1)
            ->orderBy('user_balloon_id', 'asc')
            ->orderBy('move_number', 'asc')
            ->each(function($txn) use (&$balloons) {
                if (!isset($balloons[$txn->user_balloon_id])) {
                    $balloons[$txn->user_balloon_id] = collect([]);
                    $balloons[$txn->user_balloon_id]->push($this->getPrevTxn($txn));
                }
                $balloons[$txn->user_balloon_id]->push($txn);
            });
        foreach ($balloons as $balloon_id => $txns) {
            $this->processBalloonTransactions($txns);
        }

        fwrite(self::$csvHandle, sprintf("TOTALS,,,%s,%s,%s\n",
            self::$TOTALS__PROCEEDS,
            self::$TOTALS__COSTBASIS,
            self::$TOTALS__GAINLOSS
        ));
        fclose(self::$csvHandle);

        // $headers = [
        // ];
        exit;
        // return response()->download('', $filename, $headers)->deleteFileAfterSend(true);

    }

    public function processBalloonTransactions($txns)
    {
        /**
         * The first txn is not included, because it's not part of the selected year
         * but is only used for calculations of gains for the first real transaction
         */
        $prevTxn = $txns->shift();
        $txns->each(function($txn) use (&$prevTxn) {
            $this->processTxn($prevTxn, $txn);
            $prevTxn = $txn;
        });
    }

    public function doHeaderRow($txn)
    {
        fwrite(self::$csvHandle, sprintf(
            "%s,%s,%s,%s,%s,%s\n",
            'Description',
            'Date Acquired',
            'Date Sold',
            sprintf('Proceeds (%s)', $txn->launch_currency),
            sprintf('Cost Basis (%s)', $txn->launch_currency),
            'Gain/Loss'
        ));
    }

    public function processTxn($prevTxn, $txn)
    {
        if (!self::$DID_HEADER_ROW) {
            $this->doHeaderRow($txn);
            self::$DID_HEADER_ROW = true;
        }
        $description = sprintf(
            'Balloon %s Move %s - %s %s to %s %s',
            $txn->user_balloon_id,
            $txn->move_number,
            $txn->origin_currency,
            $txn->origin_amount,
            $txn->dest_currency,
            $txn->dest_amount
        );
        fwrite(self::$csvHandle, sprintf(
            "%s,%s,%s,%s,%s,%s\n",
            $description,
            $prevTxn->transaction_timestamp,
            $txn->transaction_timestamp,
            number_format($txn->latest_amount_in_base, 2, '.', ''),
            number_format($prevTxn->latest_amount_in_base, 2, '.', ''),
            number_format($txn->latest_amount_in_base - $prevTxn->latest_amount_in_base, 2, '.', '')
        ));

        self::$TOTALS__PROCEEDS += $txn->latest_amount_in_base;
        self::$TOTALS__COSTBASIS += $prevTxn->latest_amount_in_base;
        self::$TOTALS__GAINLOSS += $txn->latest_amount_in_base - $prevTxn->latest_amount_in_base;
    }

    /**
     * Return the previous transaction from the passed transaction.  This is needed
     * for the first record we process, so that we have the previous amount.
     *
     * @param [type] $txn
     * @return Txn2|null
     */
    public function getPrevTxn($txn) {
        $prevTxn = Txns2::select(
                "user_balloon_id","move_number","transaction_timestamp",
                "origin_currency","origin_amount","dest_currency","dest_amount",
                "launch_currency","latest_amount_in_base","heleum_user"
            )
            ->where('heleum_user', $txn->heleum_user)
            ->where('user_balloon_id', $txn->user_balloon_id)
            ->where('move_number', ($txn->move_number - 1))
            ->get()
            ->first();
        return $prevTxn ? $prevTxn : new Txns2();
    }


}
