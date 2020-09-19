import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
import CreateUser from "../components/user/CreateUser.vue";
import CreateSector from "../components/sector/CreateSector.vue";
import CreateMeeting from "../components/meeting/CreateMeeting.vue";
import ListUser from "../components/user/ListUsers.vue";
import ListSectors from "../components/sector/ListSectors.vue";
import ListMeetings from "../components/meeting/ListMeetings.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
    children: [
      {
        path: "/create-user",
        name: "CreateUser",
        component: CreateUser,
      },
      {
        path: "/update-user/:id",
        name: "UpdateUser",
        component: CreateUser,
      },
      {
        path: "/list-user",
        name: "ListUser",
        component: ListUser,
      },
      {
        path: "/list-sector",
        name: "ListSectors",
        component: ListSectors,
      },
      {
        path: "/create-sector",
        name: "CreateSector",
        component: CreateSector,
      },
      {
        path: "/update-sector/:id",
        name: "UpdateSector",
        component: CreateSector,
      },
      {
        path: "/list-meeting",
        name: "ListMeetings",
        component: ListMeetings,
      },
      {
        path: "/create-meeting",
        name: "CreateMeeting",
        component: CreateMeeting,
      },
    ],
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
