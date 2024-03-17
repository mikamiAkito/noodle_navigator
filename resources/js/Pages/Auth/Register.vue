<script setup>
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import HeaderPage from '@/Components/HeaderPage.vue';
import FooterPage from '@/Components/FooterPage.vue';
import SnsIcon from '@/Components/SnsIcon.vue';

//フォーム情報
const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    profile_photo: '',
    cover_photo: '',
    terms: false,
});
//ユーザー画像処理
const setProfilePhoto = event => {
    form.profile_photo = event.target.files[0];
};
//プロフィール背景画像処理
const setCoverPhoto = event => {
    form.cover_photo = event.target.files[0];
};

//ルーティング処理
const submit = () => {
    // FormDataオブジェクトを作成してファイルを追加します。
    const formData = new FormData();
    
    // 既存のフィールドを追加
    Object.entries(form).forEach(([key, value]) => {
        formData.append(key, value);
    });

    form.post(route('register'), {
        body: formData,
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
<div>
    <Head title="Register" />
    <HeaderPage/>
        <div class="min-h-screen bg-gray-100 flex flex-col justify-center py-20 sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    アカウントを作成
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600 max-w">
                    または
                    <Link
                    :href="route('login')"
                    class="font-medium text-blue-600 hover:text-blue-500"
                    >
                        ログインはこちら
                    </Link>
                </p>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                名前
                            </label>
                            <div class="mt-1">
                                <input id="name" name="name" type="name" autocomplete="name" required v-model="form.name"
                                    class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                    placeholder="名前を入力して下さい">
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                メールアドレス
                            </label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" autocomplete="email" required v-model="form.email"
                                    class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                    placeholder="メールアドレスを入力して下さい">
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>
                        </div>

                        <!-- プロフィール画像アップロードフィールド -->
                        <div>
                            <label for="profile_photo" class="block text-sm font-medium text-gray-700">
                                プロフィール画像
                            </label>
                            <input id="profile_photo" type="file" @change="setProfilePhoto" class="mt-1">
                            <InputError class="mt-2" :message="form.errors.profile_photo" />
                        </div>

                        <!-- 背景画像アップロードフィールド -->
                        <div>
                            <label for="cover_photo" class="block text-sm font-medium text-gray-700">
                                背景画像
                            </label>
                            <input id="cover_photo" type="file" @change="setCoverPhoto" class="mt-1">
                            <InputError class="mt-2" :message="form.errors.cover_photo" />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                パスワード
                            </label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password" autocomplete="new-password" required v-model="form.password"
                                    class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                    placeholder="パスワードを入力して下さい">
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                パスワード2
                            </label>
                            <div class="mt-1">
                                <input id="password_confirmation" name="password_confirmation" type="password_confirmation" autocomplete="new-password" required v-model="form.password_confirmation"
                                    class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                    placeholder="もう一度入力して下さい">
                                <InputError class="mt-2" :message="form.errors.password_confirmation" />
                            </div>
                        </div>
                        <div>
                            <button type="submit"
                                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">

                                アカウント作成
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
