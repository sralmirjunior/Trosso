<template>
  <ion-page>
    <ion-header>
      <!--Menu com a logo-->
      <ion-toolbar color="primary">
        <ion-buttons slot="start">
          <ion-back-button :default-href="pageBackLink"></ion-back-button>
        </ion-buttons>
        <ion-title color="light">{{ pageTitle }}</ion-title>
      </ion-toolbar>
    </ion-header>
    <!--Conteudo-->
    <ion-content :fullscreen="true">
      <slot />
    </ion-content>
    <ion-footer color="primary">
      <ion-toolbar color="primary">
        <ion-grid>
          <ion-row class="ion-justify-content-evenly ion-align-items-center">
            <ion-item color="primary" lines="none" @click="openModal">
              <ion-col size="10">
                <ion-label>Adicionar quadro </ion-label>
              </ion-col>
              <ion-col size="2">
                <ion-icon :icon="addCircleOutline"></ion-icon>
              </ion-col>
            </ion-item>
          </ion-row>
        </ion-grid>
      </ion-toolbar>
    </ion-footer>
  </ion-page>
</template>

<script>
import {
  IonContent,
  IonHeader,
  IonPage,
  IonTitle,
  IonToolbar,
  IonButtons,
  IonBackButton,
  IonFooter,
  modalController,
  IonItem,
  IonGrid,
  IonRow,
  IonCol,
} from "@ionic/vue";

import ModalAddBoard from "./ModalAddBoard";

import { addCircleOutline } from "ionicons/icons";

export default {
  props: ["pageTitle", "pageBackLink"],
  components: {
    IonContent,
    IonHeader,
    IonPage,
    IonTitle,
    IonToolbar,
    IonButtons,
    IonBackButton,
    IonFooter,
    IonItem,
    IonGrid,
    IonRow,
    IonCol,
  },
  methods: {
    async openModal() {
      const modal = await modalController.create({
        component: ModalAddBoard,
      });
      return modal.present();
    },
  },
  setup() {
    return {
      addCircleOutline,
    };
  },
};
</script>

<style scoped>
ion-title {
  text-transform: uppercase;
  font-size: 30px;
}

ion-footer ion-toolbar {
  border-radius: 12px 12px 0 0;
}

ion-footer ion-label {
  text-transform: uppercase;
  font-size: 16px;
}

ion-footer ion-item ion-icon {
  width: 32px;
  height: 30px;
  margin-right: 14px;
  margin-left: 0px;
}
</style>
