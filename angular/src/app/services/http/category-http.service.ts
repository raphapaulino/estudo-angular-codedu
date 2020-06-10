import { Injectable, Component } from '@angular/core';
// import { HttpClient, HttpParams } from '@angular/common/http';
// import { Observable } from 'rxjs/internal/Observable';
// import { map } from 'rxjs/operators';
import { Category } from 'src/app/model';
// import { HttpResource } from './http-resource';
import { BaseHttp } from './http-resource';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})

@Component({ template: '' })
export class CategoryHttpService extends BaseHttp<Category> {

  // private baseUrl = 'http://localhost:8000/api/categories';
  public baseUrl() {
    return `${environment.api.url}/categories`;
  }

  // constructor(private http: HttpClient) { }

  // list(page: number): Observable<{ data: Array<Category>, meta: any }> {
  //   const token = window.localStorage.getItem('token');
  //   const params = new HttpParams({
  //     fromObject: {
  //       page: page + ""
  //     }
  //   });
  //   return this.http
  //     .get<{ data: Array<Category>, meta: any }>
  //     (this.baseUrl, {
  //       params,
  //       headers: {
  //         'Authorization': `Bearer ${token}`
  //       }
  //     });
  // }
  
  // get(id: number): Observable<Category> {
  //   const token = window.localStorage.getItem('token');
  //   return this.http
  //     .get<{ data: Category }>
  //     (`${this.baseUrl}/${id}`, {
  //       headers: {
  //         'Authorization': `Bearer ${token}`
  //       }
  //     })
  //     .pipe(
  //       map(response => response.data)
  //     ); // conceito de pipeline

  // }

  // create(data: Category): Observable<Category> {
  //   const token = window.localStorage.getItem('token');
  //   return this.http
  //     .post<{ data:Category }>(this.baseUrl, data, {
  //       headers: {
  //         'Authorization': `Bearer ${token}`
  //       }
  //     })
  //     .pipe(
  //       map(response => response.data)
  //     );
  // }

  // update(id: number, data: Category): Observable<Category> {
  //   const token = window.localStorage.getItem('token');
  //   return this.http
  //     .put<{ data:Category }>(`${this.baseUrl}/${id}`, data, {
  //       headers: {
  //         'Authorization': `Bearer ${token}`
  //       }
  //     })
  //     .pipe(
  //       map(response => response.data)
  //     );
  // }

  // destroy(id: number): Observable<any> {
  //   const token = window.localStorage.getItem('token');
  //   return this.http
  //     .delete
  //     (`${this.baseUrl}/${id}`, {
  //       headers: {
  //         'Authorization': `Bearer ${token}`
  //       }
  //     });
  // }

}
