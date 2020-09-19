<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="info">
      <b-navbar-brand href="#">Agendamento</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav class="ml-auto">
          <b-navbar-nav>
            <b-nav-item v-if="user.type_name == 'Master'">
              <router-link class="nav-link" to="/list-user">Usuários</router-link>
            </b-nav-item>
            <b-nav-item v-if="user.type_name == 'Master'">
              <router-link class="nav-link" to="/list-sector">Sectores</router-link>
            </b-nav-item>
            <b-nav-item>
              <router-link class="nav-link" to="/list-meeting">Reuniões</router-link>
            </b-nav-item>
            <b-nav-item class="nav-link" @click="logout()">Sair</b-nav-item>
          </b-navbar-nav>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>
<script>
import Service from "../service";

export default {
  data() {
    return {
      user: {
        id: 0,
        email: "",
        name: "",
        serctor_name: "",
        type_name: "",
      },
    };
  },
  created() {
    this.authUser();
  },
  methods: {
    logout() {
      localStorage.removeItem("token");
      this.$router.push("/login");
    },
    async authUser() {
      try {
        const response = await Service.userAuth();
        this.user = response.data;
      } catch (e) {
        alert("Erro ao buscar usuário logado" + e);
      }
    },
  },
};
</script>>