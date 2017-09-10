<style>
    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
</style>

@if ($errors->any())

    @foreach ($errors->all() as $error)
        <div class="alert-danger alert">
            <strong>{{__('main.err')}}</strong>{{ $error }}
        </div>
    @endforeach

@endif