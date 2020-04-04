@extends('layouts.main')

@section('content')

    <main class="main main-primary" data-show-nav-button="true" data-show-balance-button="false" data-show-back-button="false" data-back-url="/account" data-back-text="Heleum Overview" id="cnt">
        <section class="section-primary">
            <header class="section-subhead">
                <div class="container">
                    <h2 class="section-title">Support &amp; Feedback</h2><!-- /.section-title -->
                </div><!-- /.container -->
            </header><!-- /.section-subhead -->

            <div class="section-body">
                <div class="container">
                    <ul class="list-referrals list-referrals-primary">
                        <li>
                            Have a question? Search the

                            <a href="#" class="green">FAQ</a>.
                        </li>
                    </ul><!-- /.list-referrals -->

                    <div class="form-message">
                        <form action="?" method="post">
                            <div class="form-content">
                                <div class="form__row">
                                    <label for="field-message" class="form-label">Send us a message</label>

                                    <div class="form-controls">
                                        <textarea class="textarea" name="field-message" id="field-message" placeholder="Type your message here"></textarea>
                                    </div><!-- /.form__controls -->
                                </div><!-- /.form__row -->
                            </div><!-- /.form-content -->

                            <div class="form-actions">
                                <input type="submit" value="Send Message" class="form-btn">
                            </div><!-- /.form-actions -->
                        </form>
                    </div><!-- /.form-message -->
                </div><!-- /.container -->
            </div><!-- /.section-body -->
        </section><!-- /.section-primary -->
    </main><!-- /.main main-primary -->


@endsection