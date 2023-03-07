<div>
    <form method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" id="userpassword" placeholder="@lang("app.connect.phone-require")" required wire:model="phone">
        </div>
        <div class="mb-2 mt-4">
            <button class="btn btn-success w-100" type="submit">@lang("app.connect.submit")</button>
        </div>
    </form><!-- end form -->
</div>
