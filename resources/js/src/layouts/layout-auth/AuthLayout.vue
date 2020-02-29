<template>
    <v-content>
        <v-container
            class="fill-height"
            fluid
        >
            <v-row
                align="center"
                justify="center"
            >
                <v-col
                    cols="12"
                    sm="8"
                    md="4"
                >
                    <v-card class="elevation-12">
                        <v-toolbar
                            color="primary"
                            dark
                            flat
                        >
                            <v-toolbar-title>Login</v-toolbar-title>
                            <v-spacer/>
                        </v-toolbar>
                        <v-card-text>
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
                                     type="email"
                                     selected
                                     required
                                 />

                                 <v-text-field
                                     id="password"
                                     label="Password"
                                     name="password"
                                     v-model="form.password"
                                     :rules="[rules.length, rules.required]"
                                     :append-icon="passwordVisible ? 'mdi-eye-off' : 'mdi-eye'"
                                     @click:append="passwordVisible = !passwordVisible"
                                     :type="passwordVisible ? 'text' : 'password'"
                                     required
                                 />

                                 <v-checkbox
                                     v-model="form.remember"
                                     label="Remember me?"
                                 />
                            </v-form>

                            <v-btn
                                :disabled="!valid"
                                color="green"
                                type="submit"
                                rounded
                            >
                                <icon name="fas fa-sign-in-alt"/> &nbsp; Login
                            </v-btn>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-content>
</template>

<script>
    export default {
        props: {
            source: String,
        },

        data: () => ({
            valid: false,
            form: {
                email: '',
                password: '',
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
                        'Field must be between 5 and 255 characters'
                    );
                }
            }
        }),

        methods: {
            submit() {
                console.log('Submit')
            }
        }
    }
</script>

<style scoped>

</style>
