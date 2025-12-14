<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard, register } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Form, Head, useForm } from '@inertiajs/vue3';
import { store } from '@/routes/login';
import { request } from '@/routes/password';
import { Spinner } from '@/components/ui/spinner';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Checkbox } from '@/components/ui/checkbox';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import TextLink from '@/components/TextLink.vue';
import { route } from 'ziggy-js';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Posts',
        href: '/posts',
    },
    {
        title: 'Create Posts',
        href: 'posts/create',
    },
];

const form = useForm({
    title: '',
    content: '',
    image: null,
});

const submit = () => {
    form.post(route('posts.store'));
};
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="min-w-md mx-auto p-6 mt-8">
                <Form
                    v-bind="store.form()"
                    :reset-on-success="['password']"
                    v-slot="{ errors, processing }"
                    class="flex flex-col gap-6"
                >
                    <div class="grid gap-6">
                        <div class="grid gap-2">
                            <Label for="title">Title</Label>
                            <Input
                                id="title"
                                type="text"
                                name="form.title"
                                autofocus
                                :tabindex="1"
                                autocomplete="title"
                                placeholder="First Post"
                            />
                            <InputError :message="form.errors.title" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="image">Image</Label>
                            <Input
                                id="image"
                                type="file"
                                name="form.image"
                                :tabindex="2"
                                placeholder="First Post"
                            />
                            <InputError :message="form.errors.image" />
                        </div>


                        <Button
                            type="submit"
                            class="mt-4 w-full"
                            :tabindex="4"
                            :disabled="processing"
                            data-test="login-button"
                        >
                            <Spinner v-if="processing" />
                            Create
                        </Button>
                    </div>

                    <div
                        class="text-center text-sm text-muted-foreground"
                        v-if="canRegister"
                    >
                        Don't have an account?
                        <TextLink :href="register()" :tabindex="5"
                            >Sign up</TextLink
                        >
                    </div>
                </Form>
            </div>
        </div>
    </AppLayout>
</template>
