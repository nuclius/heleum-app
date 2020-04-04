<nav class="nav" id="nav">
    <div class="nav-container fullsize-background" style="background-image: url(/css/images/temp/waves.jpg);">
        <header class="nav-head">
            <button type="button" class="btn btn-clear" id="nav-close">
                <i class="ico-back"></i>
            </button>

            <div class="nav-user">
                <a href="/account">
                    <strong><?php echo e(Auth::user()->name); ?><br>&#64;<?php echo e(Auth::user()->uphold_username); ?></strong>
                    <i class="ico-baloon-5"></i>
                </a>
            </div><!-- /.nav-user -->
        </header><!-- /.nav-head -->

        <div class="nav-body">
            <ul>
                <li>
                    <a href="/account" class="js-link-internal">Account</a>
                </li>

                <?php if(Auth::user()->isVerified()): ?>
                
                <li>
                    <a href="/withdraw-funds" class="js-link-internal">Withdraw</a>
                </li>

                <li>
                    <a href="/history" class="js-link-internal">Funding History</a>
                </li>

                <li>
                    <a href="/account/csv" class="js-link-internal">Download Transactions</a>
                </li>

                <li>
                    <a href="/statistics" class="js-link-internal">Statistics</a>
                </li>

                <li>
                    <a href="/boosts" class="js-link-internal">Referrals &amp; Boosts</a>
                </li>

                <li>
                    <a href="/settings" class="js-link-internal"><?php echo app('translator')->getFromJson('Settings'); ?></a>
                </li>

                <?php else: ?>

                <li>
                    <a href="/boosts" class="js-link-internal">Referrals &amp; Boosts</a>
                </li>

                <li>
                    <a href="https://support.uphold.com/hc/en-us/articles/206119603-How-do-I-become-an-Uphold-verified-member-" class="" target="_blank">How to Get Verified</a>
                </li>

                <?php endif; ?>

                <br/>

                <li>
                    <a href="https://heleum.com/terms" class="" target="_blank">Terms &amp; Conditions</a>
                </li>
                
            </ul>
        </div><!-- /.nav-body -->

        <div class="nav-foot">
            <a href="/logout">Log Out <i class="ico-logout"></i></a>
        </div><!-- /.nav-foot desktop-only -->
    </div><!-- /.nav-container fullsize-background -->
</nav><!-- /#nav.nav -->
