<template>
    <v-container>
        <v-form
                @submit.prevent="submit"
                v-model="valid"
        >
            <v-text-field
                    id="username"
                    label="Username"
                    name="username"
                    v-model="form.username"
                    :rules="[rules.required]"
                    prepend-icon="far fa-user"
                    type="text"
                    required
            />

            <v-row>
                <v-col cols="6">
                    <v-text-field
                            id="firstname"
                            label="Firstname"
                            name="firstname"
                            class="pl-8"
                            v-model="form.firstname"
                            :rules="[rules.required]"
                            type="text"
                            required
                    />
                </v-col>

                <v-col cols="6">
                    <v-text-field
                            id="lastname"
                            label="Lastname"
                            name="lastname"
                            v-model="form.lastname"
                            :rules="[rules.required]"
                            type="text"
                            required
                    />
                </v-col>
            </v-row>

            <div class="py-3"></div>

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

            <v-row>
                <v-col cols="6">
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
                </v-col>

                <v-col cols="6">
                    <v-text-field
                            id="password_confirmation"
                            label="Confirm Password"
                            name="password_confirmation"
                            v-model="form.passwordConfirmation"
                            :rules="[rules.required]"
                            @change="passwordConfirmation"
                            :error-messages='passwordConfirmationError'
                            type="password"
                            required
                    />
                </v-col>
            </v-row>

            <v-divider class="py-3"/>

            <v-btn
                    :disabled="!valid"
                    color="green"
                    type="submit"
                    block
                    rounded
                    large
            >
                <icon name="fas fa-sign-in-alt"/> &nbsp; Register
            </v-btn>
        </v-form>
    </v-container>
</template>

<script>
    export default {
        name: "auth-component-register",

        data: () => ({
            valid: false,
            form: {
                username: '',
                firstname: '',
                lastname: '',
                email: '',
                password: '',
                passwordConfirmation: '',
            },
            passwordConfirmationError: '',
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
                },
            },
        }),

        methods: {
            passwordConfirmation() {
                if(this.form.password !== this.form.passwordConfirmation){
                    this.passwordConfirmationError = "Passwords don't match!";
                } else {
                    this.passwordConfirmationError = "";
                }
            },

            submit() {
                axios.post(
                    "api/v1/users", {
                        username: this.form.username,
                        firstname: this.form.firstname,
                        lastname: this.form.lastname,
                        email: this.form.email,
                        password: this.form.password,
                        password_confirmation: this.form.passwordConfirmation,
                    });
            },
        },
    }
</script>
