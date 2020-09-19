import axios from "axios";

let apiCliente = axios.create({
  baseURL: "http://localhost:8000/api",
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json",
  },
});

export default {
  auth(credentials) {
    return apiCliente.post("/auth/login", credentials);
  },
  getListMeetings() {
    return apiCliente.get("/meeting", {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  getListSectors() {
    return apiCliente.get("/sector", {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  getListUsers() {
    return apiCliente.get("/user", {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  getListSectors() {
    return apiCliente.get("/sector", {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  getListUserTypes() {
    return apiCliente.get("/type", {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  postUser(user) {
    return apiCliente.post("/user", user, {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  updateUser(user, id) {
    return apiCliente.patch(`/user/${id}`, user, {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  deleteUser(id) {
    return apiCliente.delete(`/user/${id}`, {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  postSector(sector) {
    return apiCliente.post("/sector", sector, {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  updateSector(sector, id) {
    return apiCliente.patch(`/sector/${id}`, sector, {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  deleteSector(id) {
    return apiCliente.delete(`/sector/${id}`, {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  postMeeting(meeting) {
    return apiCliente.post("/meeting", meeting, {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  consultMeeting(meeting) {
    return apiCliente.post("/consult-meeting", meeting, {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  consultMeetingRoom(meeting) {
    return apiCliente.post("/consult-meeting-room", meeting, {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  userAuth() {
    return apiCliente.get("/user-auth", {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  getUser(id) {
    return apiCliente.get(`/user/${id}`, {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  getSector(id) {
    return apiCliente.get(`/sector/${id}`, {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  getLocations() {
    return apiCliente.get(`/location/`, {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
  getRooms(id) {
    return apiCliente.get(`/room/${id}`, {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    });
  },
};
