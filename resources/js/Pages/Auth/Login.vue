<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    username: '',
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.email = form.username.toLowerCase();
    form.email += '@artra.co.cu';
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <AuthenticationCard>
        <template #logo>
            <img  src="/img/WelcomeBG.jpg" alt="" class="paper object-cover w-screen opacity-60 h-screen">
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <form @submit.prevent="submit" class="grid place-content-center h-screen">
            <div class="grid place-content-center py-20">
                <AuthenticationCardLogo class="rounded-full w-32 h-32 bg-zinc-800"/>
            </div>
            <div>
                <InputLabel for="email" value="Usuario" />
                <TextInput
                    id="email"
                    v-model="form.username"
                    type="text"
                    class="mt-1 block w-72"
                    required
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Contraseña" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-72"
                    required
                    autocomplete="current-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Acceder
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
