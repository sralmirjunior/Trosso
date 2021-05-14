<template>
  <ion-page>
    <ion-header>
      <!--Menu com a logo-->
      <ion-toolbar color="primary" class="ion-text-left">
        <ion-button fill="clear" slot="start" v-on:click="dismissModal()">
          <ion-icon
            color="light"
            slot="icon-only"
            :icon="arrowBackOutline"
          ></ion-icon>
        </ion-button>

        <ion-title color="light">Adicionar Quadro</ion-title>
      </ion-toolbar>
    </ion-header>
    <!--Conteudo-->
    <ion-content :fullscreen="true">
      <ion-item>
        <ion-label position="stacked">Nome do Quadro</ion-label>
        <ion-input
          inputmode="text"
          placeholder="Insira o nome do Quadro"
          required="true"
        ></ion-input>
      </ion-item>
      <ion-button color="primary">
        Salvar
      </ion-button>
    </ion-content>
  </ion-page>
</template>

<script>
import {
  IonHeader,
  IonPage,
  IonButton,
  IonLabel,
  IonContent,
  IonToolbar,
  IonIcon,
  IonTitle,
  IonItem,
  IonInput,
  modalController,
} from "@ionic/vue";

import { arrowBackOutline } from "ionicons/icons";

export default {
  name: "Home",
  components: {
    IonItem,
    IonHeader,
    IonPage,
    IonButton,
    IonLabel,
    IonContent,
    IonToolbar,
    IonIcon,
    IonTitle,
    IonInput,
  },
  methods: {
    async dismissModal() {
      await modalController.dismiss();
    },
  },
  setup() {
    return {
      arrowBackOutline,
    };
  },
};
</script>

<style scoped>
ion-item {
  width: 300px;
  margin: 30% 54px 20px auto;
}

ion-content ion-button {
  display: block;
  margin: 0 54px 0 auto;
  width: 100px;
}

ion-footer ion-label {
  text-transform: uppercase;
  font-size: 16px;
}
</style>
