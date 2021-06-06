<template>
  <layout-page pageBackLink="/home" pageTitle="Trosso">
    <div class="container" full>
      <span>Página não encontrada</span>
    </div>
  </layout-page>
</template>

<script>
import LayoutPage from "../components/LayoutPage";
export default {
  name: "404",
  components: {
    LayoutPage,
  },
};
</script>

<style scoped>
.container {
  text-align: center;
}
.container span {
  font-size: 16px;
  line-height: 22px;
  color: var(--ion-color-medium);
  text-transform: uppercase;
  font-weight: 600;
  transform: translateX(40%);
  position: absolute;
  display: block;
  margin-top: 55%;
}
</style>
