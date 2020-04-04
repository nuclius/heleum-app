@if ($errors->any())
    <div class="error-wrap container">
        <div class="row">
            <div class="two columns">&nbsp;</div>
            <div class="eight columns alert errors">
                <h3>@lang('Error')</h3>
                @foreach ($errors->all() as $error)
                    <p class="error">{{ $error }}</p>
                @endforeach
                <button type="button" class="close-error">@lang('Okay')</button>
            </div>
            <div class="two columns">&nbsp;</div>
        </div>
    </div>
@endif
