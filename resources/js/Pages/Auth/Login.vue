<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import SnsIcon from '@/Components/SnsIcon.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import HeaderPage from '@/Components/HeaderPage.vue';
import FooterPage from '@/Components/FooterPage.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
<div>
    <Head title="Login" />
    <HeaderPage/>
    <div class="min-h-screen bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                アカウントにサインイン
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600 max-w">
                または
                <Link
                :href="route('register')"
                class="font-medium text-blue-600 hover:text-blue-500"
                >
                    アカウントを作成する
                </Link>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            メールアドレス
                        </label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required v-model="form.email"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Enter your email address">
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            パスワード
                        </label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" autocomplete="current-password" required v-model="form.password"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Enter your password">
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                <Checkbox name="remember" :checked="form.remember" />
                                保存
                            </label>
                        </div>

                        <div class="text-sm">
                            <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="font-medium text-blue-600 hover:text-blue-500"
                            >
                                パスワードをお忘れの方
                            </Link>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">

                            サインイン
                        </button>
                    </div>
                </form>
                <div class="mt-6">

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-gray-100 text-gray-500">
                                またはこちらから
                            </span>
                        </div>
                    </div>
                    <SnsIcon/>
                </div>
            </div>
        </div>
    </div>
<FooterPage/>
</div>
</template>
