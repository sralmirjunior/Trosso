<template>
  <ion-item lines="none" color="light-tint" @click="$emit('click')">
    <ion-label>
      Adicionar novo cartão
    </ion-label>
  </ion-item>
</template>
<script>
import { ionItem, IonLabel } from "@ionic/vue";
export default {
  components: {
    ionItem,
    IonLabel,
  },
};
</script>
<style scoped>
ion-item {
  padding: 10px;
  background-color: var(--ion-color-light-tint);
}
ion-label {
  text-transform: uppercase;
}
</style>
