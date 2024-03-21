<script setup>
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import LogoutForm from '@/Pages/Auth/LogoutForm.vue';
import HeaderPage from '@/Components/HeaderPage.vue';
import FooterPage from '@/Components/FooterPage.vue';
import { Head } from '@inertiajs/vue3';
import UpdateImageForm from '@/Pages/Profile/Partials/UpdateImageForm.vue';

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
    profilePhotoUrl: String,
    coverPhotoUrl: String,
});

</script>

<template>
    <div>
        <Head title="Profile" />
        <HeaderPage/>
        <section class="w-full overflow-hidden dark:bg-gray-800">
            <div class="flex flex-col">
                <UpdateImageForm :profile-photo-url="profilePhotoUrl" :cover-photo-url="coverPhotoUrl"/>
                <div
                    class="xl:w-[80%] lg:w-[90%] md:w-[90%] sm:w-[92%] xs:w-[90%] mx-auto flex flex-col gap-4 items-center relative lg:-top-8 md:-top-6 sm:-top-4 xs:-top-4">
                    <!-- Detail -->
                    <div class="w-full my-auto py-6 flex flex-col justify-center gap-2">
                        <div class="w-full flex sm:flex-row xs:flex-col gap-2 justify-center">
                            <div class="w-full">
                                <dl class="text-gray-900">
                                    <div class="flex flex-col pb-3">
                                        <UpdatePasswordForm class="max-w-xl" />
                                    </div>
                                    <div class="flex flex-col pb-3">
                                        <!-- <DangerButton :href="route('logout')" method="post" as="button">logout</DangerButton> -->
                                        <UpdateProfileInformationForm
                                            :must-verify-email="mustVerifyEmail"
                                            :status="status"
                                            class="max-w-xl"
                                        />
                                    </div>                      
                                </dl>
                            </div>
                            <div class="w-full">
                                <dl class="text-gray-900">
                                    <div class="flex flex-col pt-3">
                                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800">
                                        </div>
                                        <div class="flex flex-col py-3">
                                            <LogoutForm/>
                                        </div>
                                        <div class="flex flex-col py-3">
                                            <DeleteUserForm class="max-w-xl" />
                                        </div>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <FooterPage/>
    </div>
</template>
