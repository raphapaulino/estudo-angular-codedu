export const environment = {
  production: true,
  api: {
    protocol: 'http',
    host: 'angularproject.633k.com.br',
    get url() {
      return `${this.protocol}://${this.host}/api`;
    }
  }
};
