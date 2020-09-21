<template>
  <form @submit.prevent="submit()">
    <div class="row">
      <div class="col-md-12">
        <b-form-group id="input-group-name" label="Nome:" label-for="input-name" label-align="left">
          <b-form-input
            id="input-name"
            type="text"
            required
            placeholder="Ex: Serviço geraris"
            v-model="sector.name"
          ></b-form-input>
        </b-form-group>
      </div>
      <div class="col-md-12 text-right">
        <router-link to="/list-sector" class="btn btn-danger mr-2" type="submit">Cancelar</router-link>
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
      sector: {
        name: "",
      },
    };
  },
  created() {
    if (this.$route.params.id) {
      this.getSector(this.$route.params.id);
    }
  },
  methods: {
    async postSector() {
      try {
        const response = await Service.postSector(this.sector);
        alert("Setor cadastrado");
        this.$router.push("/list-sector");
      } catch (e) {
        alert("Erro cadastrar setor" + e);
      }
    },
    async updateSector() {
      try {
        const response = await Service.updateSector(
          this.sector,
          this.$route.params.id
        );
        alert("Setor alterado");
        this.$router.push("/list-sector");
      } catch (e) {
        alert("Erro alterar setor" + e);
      }
    },
    submit() {
      if (this.$route.name == "CreateSector") {
        this.postSector();
      } else {
        this.updateSector();
      }
    },
    async getSector(id) {
      try {
        const response = await Service.getSector(id);
        this.sector = response.data;
      } catch (e) {
        alert("Erro buscar setor: " + e);
      }
    },
  },
};
</script>