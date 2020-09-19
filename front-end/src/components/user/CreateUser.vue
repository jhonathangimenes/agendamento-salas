<template>
  <form @submit.prevent="submit()">
    <div class="row">
      <div class="col-md-6">
        <b-form-group id="input-group-name" label="Nome:" label-for="input-name" label-align="left">
          <b-form-input
            id="input-name"
            type="text"
            required
            placeholder="Ex: João Gomes"
            v-model="user.name"
          ></b-form-input>
        </b-form-group>
      </div>
      <div class="col-md-6" v-if="this.$route.name == 'CreateUser'">
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
            placeholder="Ex: Joaogomes@hotmai.com"
            v-model="user.email"
          ></b-form-input>
        </b-form-group>
      </div>
      <div class="col-md-6">
        <b-form-group
          id="input-group-phone"
          label="Telefone:"
          label-for="input-phone"
          label-align="left"
        >
          <b-form-input
            id="input-phone"
            type="text"
            required
            placeholder="(99) 99999-9999"
            v-model="user.phone"
          ></b-form-input>
        </b-form-group>
      </div>
      <div class="col-md-6" v-if="this.$route.name == 'CreateUser'">
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
            v-model="user.password"
          ></b-form-input>
        </b-form-group>
      </div>
      <div class="col-md-6">
        <b-form-group
          id="input-group-phone"
          label="Setor:"
          label-for="input-phone"
          label-align="left"
        >
          <b-form-select v-model="user.sector_id" :options="sectors"></b-form-select>
        </b-form-group>
      </div>
      <div class="col-md-6">
        <b-form-group id="input-group-type" label="Tipo:" label-for="input-type" label-align="left">
          <b-form-select v-model="user.type_id" :options="userTypes"></b-form-select>
        </b-form-group>
      </div>
      <div class="col-md-12 text-right">
        <router-link to="/list-user" class="btn btn-danger mr-2" type="submit">Cancelar</router-link>
        <b-button type="submit" variant="primary">Entrar</b-button>
      </div>
    </div>
  </form>
</template>
<script>
import Service from "../../service";

export default {
  data() {
    return {
      user: {
        name: "",
        email: "",
        phone: "",
        password: "",
        sector_id: 0,
        type_id: 0,
      },
      sectors: [],
      userTypes: [],
    };
  },
  created() {
    this.getListSectors();
    this.getListUserTypes();
    if (this.$route.params.id) {
      this.getUser(this.$route.params.id);
    }
  },
  methods: {
    async getListSectors() {
      try {
        const response = await Service.getListSectors();
        response.data.forEach((sector) => {
          this.sectors.push({ value: sector.id, text: sector.name });
        });
      } catch (e) {
        alert("Erro listar setores: " + e);
      }
    },
    async getListUserTypes() {
      try {
        const response = await Service.getListUserTypes();
        response.data.forEach((type) => {
          this.userTypes.push({ value: type.id, text: type.name });
        });
      } catch (e) {
        alert("Erro listar setores: " + e);
      }
    },
    submit() {
      if (this.$route.name == "CreateUser") {
        this.postUser();
      } else {
        this.updateUser();
      }
    },
    async postUser() {
      try {
        const response = await Service.postUser(this.user);
        alert("Usuário cadastrado");
        this.$router.push("/list-user");
      } catch (e) {
        alert("Erro cadastrar usuário: " + e);
      }
    },
    async updateUser() {
      try {
        const response = await Service.updateUser(
          this.user,
          this.$route.params.id
        );
        alert("Usuário alterado");
        this.$router.push("/list-user");
      } catch (e) {
        alert("Erro alterar usuario: " + e);
      }
    },
    async getUser(id) {
      try {
        const response = await Service.getUser(id);
        this.user = response.data;
      } catch (e) {
        alert("Erro buscar usuário: " + e);
      }
    },
  },
};
</script>