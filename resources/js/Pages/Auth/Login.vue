<template>


        <Head><title>
            Login
        </title>
            <link rel="icon" href="/images/dq.jpeg" type="image/x-icon"/>
        </Head>

    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
        <!-- Card -->
        <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Sign in to Dukani Kwangu
            </h2>
            <form class="mt-8 space-y-6" @submit.prevent="submit">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Email/Username</label>
                    <input type="text"
                           v-model="form.username"
                           name="email" id="email"
                           placeholder="johndoe"
                           :class="[form.errors.username!=null?'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500':'bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500']" required>
                    <div v-if="form.errors.username" class="error-label">{{ form.errors.username }}</div>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                    <input type="password"
                           v-model="form.password"
                           name="password" id="password"
                           placeholder="••••••••"
                           :class="[form.errors.password!=null?'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500':'bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500']" required>
                    <div v-if="form.errors.password" class="error-label">{{ form.errors.password }}</div>
                </div>
                <div class="flex justify-between">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" required>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember" class="font-medium text-gray-900 dark:text-white">Remember me</label>
                        </div>

                    </div>

                    <Link href="#" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">Lost Password?</Link>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>

            </form>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                Not registered? <Link :href="route('auth.register')" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">Create account</Link>
            </div>
        </div>
    </div>




</template>



<script>

    import { Head } from '@inertiajs/vue3'
    import {useForm,Link} from "@inertiajs/vue3";


    export default {
        name:'Login',
        data() {
            return {
                form: useForm({
                    username: null,
                    password: null,
                }),
            }
        },
        components: {
            Head,
            Link,

        },
        methods:{
            submit() {
                this.form.post(route('auth.login.store'))
            },
        },

    }
</script>
