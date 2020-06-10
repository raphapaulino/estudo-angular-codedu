import { Observable } from 'rxjs/internal/Observable';
import { HttpClient, HttpParams } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { Component } from '@angular/core';
import { AuthService } from '../auth.service';

export interface SearchParams {
  page?: number;
  all?: any;
  search?: string;
  sort?: {
    column: string;
    sort: string;
  }
}

export class SearchParamsBuilder {
  constructor(private searchParams: SearchParams) { }

  makeObject(): SearchParams {
    const sParams: any = {
      page: this.searchParams.page + "",
    }
    if (this.searchParams.all) {
      sParams.all = '1';
      delete sParams.page;
    }
    if (this.searchParams.search && this.searchParams.search !== '') {
      sParams.search = this.searchParams.search;
    }
    if (this.searchParams.sort) {
      const sortSymbol = this.searchParams.sort.sort === 'desc' ? '-' : '';
      const columnName = this.searchParams.sort.column;
      sParams.sort = `${sortSymbol}${columnName}`;
    }
    return sParams;
  }
}

export interface HttpResource<T> {

  list(page: number): Observable<{ data: Array<T>, meta: any }>;

  listWithParams(searchParams: SearchParams): Observable<{ data: Array<T>, meta: any }>;
  
  get(id: number): Observable<T>;

  create(data: T): Observable<T>;

  update(id: number, data: T): Observable<T>;

  destroy(id: number): Observable<any>;

}

/** Tip @source https://medium.com/@ozak/stop-repeating-yourself-in-angular-how-to-create-abstract-components-9726d43c99ab */
/**
 * If you have noticed, we used the Component decorator instead of an abstract class. This is my preferred way to define a base component because of how dependency injection system works. When you use an abstract class and inject anything to it, you need to call super and inject them in your the constructor of your subclasses as well. While it is true that Injector helps you with this, you can avoid that constructor and the super call when you use the decorator instead and declare the component in a module. This is particularly useful when working with abstract components which are used repeatedly in your project, just like the one we have in this example.
 * You probably have noticed that our abstract component has a generic type: <T = any>. This is particularly useful when you have a variety of models applicable and would like to get the proper interface when referring to the inherited value. Generics can also have a default type, any in this case, to prevent pointless errors when defining one is redundant.
 */
@Component({ template: '' })
export abstract class BaseHttp<T> implements HttpResource<T> {

  constructor(private http: HttpClient, private authService: AuthService) { }

  abstract baseUrl();

  list(page: number): Observable<{ data: T[]; meta: any; }> {
    const params = new HttpParams({
      fromObject: {
        page: page + ""
      }
    });
    return this.http.get<{ data: T[], meta: any }>(this.baseUrl(), { params });
  }

  listWithParams(searchParams: SearchParams): Observable<{ data: T[]; meta: any; }> {
    const sParams = new SearchParamsBuilder(searchParams).makeObject();
    const params = new HttpParams({ fromObject: (<any>sParams) });
    return this.http.get<{ data: T[], meta: any }>(this.baseUrl(), {params});
  }
  
  get(id: number): Observable<T> {
      return this.http
        .get<{ data: T }>(`${this.baseUrl()}/${id}`)
        .pipe(
          map(response => response.data)
        ); // conceito de pipeline
  }

  create(data: T): Observable<T> {
      return this.http
        .post<{ data: T }>(this.baseUrl(), data)
        .pipe(
          map(response => response.data)
        );
  }

  update(id: number, data: T): Observable<T> {
      return this.http
        .put<{ data: T }>(`${this.baseUrl()}/${id}`, data)
        .pipe(
          map(response => response.data)
        );
  }

  destroy(id: number): Observable<any> {
      return this.http.delete(`${this.baseUrl()}/${id}`);
  }

}