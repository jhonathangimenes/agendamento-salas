<template>
  <div>
    <div class="text-right">
      <router-link to="/create-meeting" class="btn btn-success mb-2" type="submit">Cadastrar Reunião</router-link>
    </div>
    <div class="table-responsive-lg">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>Local</th>
            <th>Data</th>
            <th>Usuário</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="meeting in meetings" :key="meeting.id">
            <td>{{ meeting.location_name }} - {{ meeting.room_name }}</td>
            <td>{{ formatedDate(meeting.start_date,meeting.end_date) }}</td>
            <td>{{ meeting.user_name }} - {{ meeting.sector_name }}</td>
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
      meetings: [],
    };
  },
  created() {
    this.getListMeetings();
  },
  methods: {
    async getListMeetings() {
      try {
        const response = await Service.getListMeetings();
        this.meetings = response.data;
      } catch (e) {
        alert("Erro ao listar as reuniões");
      }
    },
    formatedDate(stringStartDate, stringEndDate) {
      const startDate = new Date(stringStartDate);
      const endDate = new Date(stringEndDate);
      return `${
        startDate.getDate() < 10
          ? "0" + startDate.getDate()
          : startDate.getDate()
      }/${
        startDate.getMonth() < 10
          ? "0" + startDate.getMonth()
          : startDate.getMonth()
      }/${startDate.getFullYear()}
       ${
         startDate.getHours() < 10
           ? "0" + startDate.getHours()
           : startDate.getHours()
       }:${
        startDate.getMinutes() < 10
          ? "0" + startDate.getMinutes()
          : startDate.getMinutes()
      } as 
       ${
         endDate.getHours() < 10 ? "0" + endDate.getHours() : endDate.getHours()
       }:${
        endDate.getMinutes() < 10
          ? "0" + endDate.getMinutes()
          : endDate.getMinutes()
      }`;
    },
  },
};
</script>