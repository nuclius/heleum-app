@extends('layouts.main')

@section('content')

    <main class="main main-primary"
        data-show-nav-button="true"
        data-show-balance-button="true"
        data-show-back-button="false"
        id="cnt"
        >
        <section class="section-secondary">
            <header class="section-head">
                <div class="container">
                    <h2>Funding History</h2>
                </div><!-- /.container -->
            </header><!-- /.section-head -->

            <div class="section-body">
                <div class="container">
                    <div class="table-history">
                        <table>
                            @foreach ($accountTxns as $txn)
                                @if (!empty($txn->withdrawal_id))
                                    @include('history.withdrawal-row', ['txn' => $txn])
                                @elseif (!empty($txn->fee_id))
                                    @include('history.fee-row', ['txn' => $txn])
                                @else
                                    @include('history.funding-row', ['txn' => $txn])
                                @endif
                            @endforeach
                        </table>
                    </div><!-- /.table-history -->
                </div><!-- /.container -->
            </div><!-- /.section-body -->
        </section><!-- /.section-secondary -->
    </main><!-- /.main main-primary -->

@endsection