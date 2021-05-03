<template>
  <ion-content class="ion-padding">
    <ion-header>
      <!--Menu com a logo-->
      <ion-toolbar color="primary">
        <ion-buttons slot="start">
          <ion-back-button :default-href="pageBackLink"></ion-back-button>
        </ion-buttons>
        <ion-title color="light">{{ pageTitle }}</ion-title>
      </ion-toolbar>
    </ion-header>
    {{ content }}
  </ion-content>
</template>

<script>
import { IonContent } from "@ionic/vue";
import { defineComponent } from "vue";

export default defineComponent({
  components: { IonContent },

  props: {
    title: { type: String, default: "Super Modal" },
  },
  data() {
    return {
      content: "Content",
    };
  },
});
</script>
