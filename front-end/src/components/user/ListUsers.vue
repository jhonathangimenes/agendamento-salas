<template>
  <div>
    <div class="text-right">
      <router-link to="/create-user" class="btn btn-success mb-2" type="submit">Cadastrar Usuário</router-link>
    </div>
    <div class="table-responsive-lg">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Setor</th>
            <th>Tipo</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.phone }}</td>
            <td>{{ user.sector_name }}</td>
            <td>{{ user.type_name }}</td>
            <td>
              <router-link class="btn btn-primary mr-1 mb-1" :to="`update-user/${user.id}`">Alterar</router-link>
              <button class="btn btn-danger mb-1" @click="deleteUser(user.id)">Excluir</button>
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
      users: [],
    };
  },
  created() {
    this.getListUsers();
  },
  methods: {
    async getListUsers() {
      try {
        const response = await Service.getListUsers();
        this.users = response.data;
      } catch (e) {
        alert("Erro ao listar as usuários");
      }
    },
    async deleteUser(id) {
      if (window.confirm("Tem certeza que deseja apagar este usuário")) {
        try {
          const response = await Service.deleteUser(id);
          this.getListUsers();
        } catch (e) {
          alert("Erro ao excluir usuário");
        }
      }
    },
  },
};
</script>