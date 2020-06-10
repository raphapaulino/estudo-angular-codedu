import { Injectable, Component } from '@angular/core';
import { User } from 'src/app/model';
import { BaseHttp } from './http-resource';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})

@Component({ template: '' })
export class UserHttpService extends BaseHttp<User> {

  // constructor() { }

  public baseUrl() {
    return `${environment.api.url}/users`;
  }
}
