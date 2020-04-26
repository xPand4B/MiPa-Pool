<template>
    <div>
        <v-form
                @submit.prevent="submit"
                v-model="valid"
        >
            <v-text-field
                    id="email"
                    label="E-Mail"
                    name="email"
                    v-model="form.email"
                    :rules="[rules.email, rules.length, rules.required]"
                    prepend-icon="far fa-envelope"
                    type="email"
                    required
            />

            <v-text-field
                    id="password"
                    label="Password"
                    name="password"
                    v-model="form.password"
                    :rules="[rules.length, rules.required]"
                    prepend-icon="fas fa-key"
                    :append-icon="passwordVisible ? 'mdi-eye-off' : 'mdi-eye'"
                    @click:append="passwordVisible = !passwordVisible"
                    :type="passwordVisible ? 'text' : 'password'"
                    required
            />

            <v-checkbox
                    v-model="form.remember"
                    label="Remember me?"
            />

            <v-divider class="py-3"/>

            <v-btn
                    :disabled="!valid"
                    color="green"
                    type="submit"
                    rounded
                    block
                    large
            >
                <icon name="fas fa-sign-in-alt"/> &nbsp; Login
            </v-btn>
        </v-form>
    </div>
</template>

<script>
    export default {
        name: "auth-component-login",

        data: () => ({
            valid: false,
            form: {
                email: 'xpand.4beatz@gmail.com',
                password: 'secret',
                remember: false
            },
            passwordVisible: false,
            rules: {
                required: value => !!value || 'Field is required',
                email: value => {
                    const pattern = /.+@.+\..+/;
                    return (
                        pattern.test(value) ||
                        'E-Mail must be valid.'
                    );
                },
                length: value => {
                    const minLength = 5;
                    const maxLength = 255;
                    return (
                        (value.length >= minLength && value.length <= maxLength) ||
                        `Field must be between ${minLength} and ${maxLength} characters`
                    );
                }
            },
        }),

        methods: {
            submit() {
                if (!this.valid) {
                    return;
                }

                this.$store.dispatch('login', this.form);
            },
        },
    }
</script>
