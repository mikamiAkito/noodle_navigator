<script setup>
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import LogoutForm from '@/Pages/Auth/LogoutForm.vue';
import HeaderPage from '@/Components/HeaderPage.vue';
import FooterPage from '@/Components/FooterPage.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});
</script>

<template>
    <div>
        <Head title="Profile" />
        <HeaderPage/>
        <section class="w-full overflow-hidden dark:bg-gray-900">
            <div class="flex flex-col">
                <!-- Cover Image -->
                <img src="https://images.unsplash.com/photo-1513542789411-b6a5d4f31634?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHwxM3x8Y292ZXJ8ZW58MHwwfHx8MTcxMDU2OTcxM3ww&ixlib=rb-4.0.3&q=80&w=1080" alt="User Cover"
                        class="w-full xl:h-[20rem] lg:h-[18rem] md:h-[16rem] sm:h-[14rem] xs:h-[11rem]" />
                <!-- Profile Image -->
                <div class="sm:w-[80%] xs:w-[90%] mx-auto flex">
                    <img src="https://media.licdn.com/dms/image/C4E35AQHzFh4OzuHCVA/profile-framedphoto-shrink_200_200/0/1618420506345?e=1711180800&amp;v=beta&amp;t=bKkUpE3XmQTZxb9ivRCoCyv29rqNC1TWqgsktZ4fNLw" alt="User Profile"
                            class="rounded-md lg:w-[12rem] lg:h-[12rem] md:w-[10rem] md:h-[10rem] sm:w-[8rem] sm:h-[8rem] xs:w-[7rem] xs:h-[7rem] outline outline-2 outline-offset-2 outline-blue-500 relative lg:bottom-[5rem] sm:bottom-[4rem] xs:bottom-[3rem]" />
                    <!-- FullName -->
                    <h1 class="w-full text-left my-4 sm:mx-4 xs:pl-4 text-gray-800 dark:text-white lg:text-4xl md:text-3xl sm:text-3xl xs:text-xl font-serif">
                        {{ $page.props.auth.user.name }}
                    </h1>
                </div>
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
                                        <div class="p-4 sm:p-8 bg-white">
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
