<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    @if (session('status') === 'password-updated')
        @php
            flash(__('Пароль успешно изменён'))->success();
        @endphp
    @endif

    @include('flash::message')


    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6">
            <x-input-label class="form-label" for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                          class="form-control {{ count($errors->updatePassword->get('current_password'))!==0 ? 'is-invalid' : null }}
                          mt-1 block w-full" autocomplete="current-password" />
            {{--<x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />--}}
            <x-b.input-invalid-feedback :messages="$errors->updatePassword->get('current_password')"/>
        </div>


        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6">
            <x-input-label class="form-label" for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password"
                          class="form-control {{ count($errors->updatePassword->get('password'))!==0 ? 'is-invalid' : null }}
                          mt-1 block w-full" autocomplete="new-password" />
            {{--<x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />--}}
            <x-b.input-invalid-feedback :messages="$errors->updatePassword->get('password')"/>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6">
            <x-input-label class="form-label" for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                          class="form-control {{ count($errors->updatePassword->get('password_confirmation'))!==0 ? 'is-invalid' : null }}
                          mt-1 block w-full" autocomplete="new-password" />
            {{--<x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />--}}
            <x-b.input-invalid-feedback :messages="$errors->updatePassword->get('password_confirmation')"/>
        </div>

        <div class="flex items-center gap-4">
            {{--<x-primary-button>{{ __('Save') }}</x-primary-button>--}}
            <button type="submit" class="btn btn-outline-secondary mt-3">
                {{ __('Save') }}
            </button>


{{--            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif--}}
        </div>
    </form>
</section>
