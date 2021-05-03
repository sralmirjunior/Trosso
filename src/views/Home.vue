<template>
  <layout-base-page pageTitle="Trosso">
    <div id="container">
      <span>sem quadros existentes</span>
    </div>
  </layout-base-page>
</template>

<script>
import LayoutBasePage from "../components/LayoutBasePage.vue";

export default {
  name: "Home",
  components: {
    LayoutBasePage,
  },
};
</script>

<style scoped>
#container {
  text-align: center;
  position: absolute;
  left: 0;
  right: 0;
  top: 50%;
  transform: translateY(-50%);
}

#container span {
  font-size: 16px;
  line-height: 22px;
  color: var(--ion-color-medium);
  margin: 0;
  text-transform: uppercase;
  font-weight: 600;
}
</style>
