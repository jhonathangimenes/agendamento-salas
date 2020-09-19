<template>
  <div class="container mt-5">
    <form @submit.prevent="auth()">
      <div class="mx-auto" style="max-width: 500px;">
        <b-card header="Login" header-tag="header">
          <b-form-group
            id="input-group-email"
            label="Email address:"
            label-for="input-email"
            label-align="left"
          >
            <b-form-input
              id="input-email"
              type="email"
              required
              placeholder="Enter email"
              v-model="email"
            ></b-form-input>
          </b-form-group>
          <b-form-group
            id="input-group-password"
            label="Password:"
            label-for="input-password"
            label-align="left"
          >
            <b-form-input
              id="input-password"
              type="password"
              required
              placeholder="Password"
              v-model="password"
            ></b-form-input>
            <b-button class="mt-3" type="submit" block variant="primary">Entrar</b-button>
          </b-form-group>
        </b-card>
      </div>
    </form>
  </div>
</template>
<script>
import Service from "../service";

export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    async auth() {
      try {
        const response = await Service.auth({
          email: this.email,
          password: this.password,
        });
        localStorage.setItem("token", response.data.access_token);
        this.$router.push("/list-meeting");
      } catch (e) {
        alert("Email ou senha estão incorretas");
      }
    },
  },
};
</script>
