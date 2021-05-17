<template>
  <ion-page>
    <ion-header>
      <!--Menu com a logo-->
      <ion-toolbar color="primary" class="ion-text-left">
        <ion-button fill="clear" slot="start" @click="dismissModal()">
          <ion-icon
            color="light"
            slot="icon-only"
            :icon="arrowBackOutline"
          ></ion-icon>
        </ion-button>
        <ion-title color="light">{{ modalTitle }}</ion-title>
      </ion-toolbar>
    </ion-header>
    <!--Conteudo-->
    <ion-content :fullscreen="true">
      <slot />
    </ion-content>
  </ion-page>
</template>

<script>
import {
  IonHeader,
  IonPage,
  IonButton,
  IonContent,
  IonToolbar,
  IonIcon,
  IonTitle,
  modalController,
} from "@ionic/vue";

import { arrowBackOutline } from "ionicons/icons";

export default {
  props: {
    modalTitle: {
      type: String,
    },
  },
  components: {
    IonHeader,
    IonPage,
    IonButton,
    IonContent,
    IonToolbar,
    IonIcon,
    IonTitle,
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
ion-content ion-button {
  margin: 0 auto;
}
</style>
