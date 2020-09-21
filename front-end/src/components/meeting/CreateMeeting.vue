<template>
  <form @submit.prevent="consultMeeting()">
    <div class="mx-auto" style="max-width: 500px;">
      <label for="start_date">Data</label>
      <b-form-datepicker id="start_date" placeholder="Escolha a data" v-model="date" class="mb-2"></b-form-datepicker>
      <div class="row">
        <div class="col-md-6 text-center">
          <p>Horário de início</p>
          <b-time v-model="start_time" locale="pt-br"></b-time>
        </div>
        <div class="col-md-6 text-center">
          <p>Horário de encerramento</p>
          <b-time v-model="end_time" locale="pt-br"></b-time>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <b-form-group
            id="input-group-type"
            label="Local:"
            label-for="input-type"
            label-align="left"
          >
            <b-form-select v-model="location_id" @change="getRooms()" :options="locations"></b-form-select>
          </b-form-group>
        </div>
        <div class="col-md-6">
          <b-form-group
            id="input-group-type"
            label="Sala:"
            label-for="input-type"
            label-align="left"
          >
            <b-form-select v-model="room_id" :options="rooms"></b-form-select>
          </b-form-group>
        </div>
      </div>
      <div class="col-md-12 p-0 text-right mt-2 mb-5">
        <router-link to="/list-meeting" class="btn btn-danger mr-2" type="submit">Cancelar</router-link>
        <b-button type="submit" variant="primary">Salvar</b-button>
      </div>
    </div>
  </form>
</template>

<script>
import Service from "../../service";

export default {
  data() {
    return {
      date: "",
      start_time: "",
      end_time: "",
      location_id: 0,
      room_id: 0,
      locations: [],
      rooms: [],
    };
  },
  created() {
    this.getLocations();
  },
  methods: {
    async postMeeting() {
      try {
        const response = await Service.postMeeting({
          start_date: `${this.date}T${this.start_time}`,
          end_date: `${this.date}T${this.end_time}`,
          room_id: this.room_id,
        });
        alert("Reunião cadastrada");
        this.$router.push("/list-meeting");
      } catch (e) {
        alert("Erro cadastrar reunião" + e);
      }
    },
    async consultMeeting() {
      const meeting = {
        start_date: `${this.date}T${this.start_time}`,
        end_date: `${this.date}T${this.end_time}`,
        room_id: this.room_id,
      };

      let start_date = new Date(`${this.date}T${this.start_time}`);
      let end_date = new Date(`${this.date}T${this.end_time}`);

      let timeMeeting = end_date - start_date;
      if (timeMeeting < 0) {
        alert("Data de encerramento não pode ser menor que data de início");
      } else if (timeMeeting <= 3600000) {
        try {
          const response = await Service.consultMeeting(meeting);
          try {
            const response = await Service.consultMeetingRoom(meeting);
            this.postMeeting();
          } catch (e) {
            alert("Já existe reunião marcada nessa sala nesse horario");
          }
        } catch (e) {
          alert("Você já tem reunião marcada nesse dia");
        }
      } else {
        alert("Tempo de reunião limite é de 1 hora.");
      }
    },
    async getLocations() {
      try {
        const response = await Service.getLocations();
        response.data.forEach((location) => {
          this.locations.push({ value: location.id, text: location.name });
        });
      } catch (e) {
        alert("Erro listar locais: " + e);
      }
    },
    async getRooms() {
      console.log(this.location_id);
      try {
        const response = await Service.getRooms(this.location_id);
        this.rooms = [];
        response.data.forEach((room) => {
          this.rooms.push({ value: room.id, text: room.name });
        });
      } catch (e) {
        alert("Erro listar locais: " + e);
      }
    },
  },
};
</script>