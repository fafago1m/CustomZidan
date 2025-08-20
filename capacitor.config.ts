import type { CapacitorConfig } from '@capacitor/cli';

const config: CapacitorConfig = {
  appId: 'com.example.app',
  appName: 'Zidan Store',
  webDir: 'public',
  server: {
    androidScheme: 'https'
  }
};

export default config;
