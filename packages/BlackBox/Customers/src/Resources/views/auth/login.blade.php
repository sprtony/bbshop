<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use App\Providers\RouteServiceProvider;

new class extends Component {
    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required')]
    public string $password = '';

    public bool $remember = false;

    public function authenticate()
    {
        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));

            return;
        }

        return redirect()->intended(RouteServiceProvider::PROFILE);
    }
};

?>

@extends('layout.master')

@section('title', 'Sign in to your account')


@section('content')
    @volt('login')
        <div>
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900">
                    Sign in to your account
                </h2>

                <p class="mt-2 text-sm leading-5 text-center text-gray-600 max-w">
                    Or
                    <a href="{{ route('register') }}"
                        class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500 focus:underline focus:outline-none">
                        create a new account
                    </a>
                </p>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="py-8 px-4 bg-white shadow sm:px-10 sm:rounded-lg">
                    <form wire:submit="authenticate">
                        <div>
                            <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                                Email address
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model.blur="email" id="email" name="email" type="email" required autofocus
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                                Password
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model.blur="password" id="password" type="password" required
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-between items-center mt-6">
                            <div class="flex items-center">
                                <input wire:model.blur="remember" id="remember" type="checkbox"
                                    class="w-4 h-4 text-indigo-600 transition duration-150 ease-in-out form-checkbox" />
                                <label for="remember" class="block ml-2 text-sm leading-5 text-gray-900">
                                    Remember
                                </label>
                            </div>

                            <div class="text-sm leading-5">
                                <a href="{{ route('password.request') }}"
                                    class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500 focus:underline focus:outline-none">
                                    Forgot your password?
                                </a>
                            </div>
                        </div>

                        <div class="mt-6">
                            <span class="block w-full rounded-md shadow-sm">
                                <button type="submit"
                                    class="flex justify-center py-2 px-4 w-full text-sm font-medium text-white bg-indigo-600 rounded-md border border-transparent transition duration-150 ease-in-out hover:bg-indigo-500 focus:border-indigo-700 focus:outline-none active:bg-indigo-700 focus:ring-indigo">
                                    Sign in
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endvolt
@endsection
