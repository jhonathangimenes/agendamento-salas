<template>
  <div>
    <Navbar />
    <div class="container mt-5">
      <router-view />
    </div>
  </div>
</template>

<script>
import Navbar from "@/components/NavBar.vue";

export default {
  name: "Home",
  components: {
    Navbar,
  },
  created() {
    if (!localStorage.getItem("token")) {
      this.$router.push("/login");
    }
  },
};
</script>
