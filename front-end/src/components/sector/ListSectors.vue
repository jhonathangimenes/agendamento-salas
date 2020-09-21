<template>
  <div>
    <div class="text-right">
      <router-link to="/create-sector" class="btn btn-success mb-2" type="submit">Cadastrar Sector</router-link>
    </div>
    <div class="table-responsive-lg">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>Nome</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="sector in sectors" :key="sector.id">
            <td>{{ sector.name }}</td>
            <td>
              <router-link
                class="btn btn-primary mr-1 mb-1"
                :to="`update-sector/${sector.id}`"
              >Alterar</router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Service from "../../service";

export default {
  data() {
    return {
      sectors: [],
    };
  },
  created() {
    this.getListSectors();
  },
  methods: {
    async getListSectors() {
      try {
        const response = await Service.getListSectors();
        this.sectors = response.data;
      } catch (e) {
        alert("Erro ao listar as setores");
      }
    },
  },
};
</script>