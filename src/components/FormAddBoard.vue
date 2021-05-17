<template>
  <form>
    <ion-item>
      <ion-label position="stacked">Nome do Quadro</ion-label>
      <ion-input
        inputmode="text"
        placeholder="Insira o nome do Quadro"
        required="true"
      ></ion-input>
    </ion-item>
    <ion-button expand="block" color="primary">
      Salvar
    </ion-button>
  </form>
</template>

<script>
import { IonButton, IonLabel, IonItem, IonInput } from "@ionic/vue";

export default {
  components: {
    IonItem,
    IonButton,
    IonLabel,
    IonInput,
  },
};
</script>

<style scoped>
form {
  padding: 15%;
}
ion-item {
  margin: 30% auto 15% auto;
}

ion-content ion-button {
  margin: 0 auto;
}
</style>
