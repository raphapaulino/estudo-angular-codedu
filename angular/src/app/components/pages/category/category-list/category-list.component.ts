import { Component, OnInit, ViewChild } from '@angular/core';
import { CategoryNewModalComponent } from '../category-new-modal/category-new-modal.component';
import { CategoryEditModalComponent } from '../category-edit-modal/category-edit-modal.component';
import { CategoryDeleteModalComponent } from '../category-delete-modal/category-delete-modal.component';
import { CategoryHttpService } from 'src/app/services/http/category-http.service';
import { Category } from '../../../../model';
import { CategoryInsertService } from './category-insert.service';
import { CategoryEditService } from '../category-edit-modal/category-edit.service';
import { CategoryDeleteService } from '../category-delete-modal/category-delete.service';

declare let $;

@Component({
  selector: 'app-category-list',
  templateUrl: './category-list.component.html',
  styleUrls: ['./category-list.component.css']
})
export class CategoryListComponent implements OnInit {

  categories: Array<Category> = [];
  pagination = {
    page: 1,
    totalItems: 0,
    itemsPerPage: 10
  }
  sortColumn = {column: '', sort: ''};
  categoryId: number;
  searchText: string;

  @ViewChild(CategoryNewModalComponent)
  categoryNewModal: CategoryNewModalComponent;

  @ViewChild(CategoryEditModalComponent)
  categoryEditModal: CategoryEditModalComponent;

  @ViewChild(CategoryDeleteModalComponent)
  categoryDeleteModal: CategoryDeleteModalComponent;

  constructor(private categoryHttp: CategoryHttpService,
              public categoryInsertService: CategoryInsertService,
              public categoryEditService: CategoryEditService,
              public categoryDeleteService: CategoryDeleteService) {
    this.categoryInsertService.categoryListComponent = this;
    this.categoryEditService.categoryListComponent = this;
    this.categoryDeleteService.categoryListComponent = this;
  }

  ngOnInit(): void {
    this.getCategories();
  }

  getCategories() {
    this.categoryHttp.listWithParams({
      page: this.pagination.page,
      // sort: this.sortColumn === '' ? null : this.sortColumn
      sort: this.sortColumn,
      search: this.searchText
    })
      .subscribe(response => {
        this.categories = response.data
        this.pagination.totalItems = response.meta.total
        this.pagination.itemsPerPage = response.meta.per_page
      });
  }

  pageChanged(page) {
    this.pagination.page = page;
    this.getCategories();
  }

  sort(sortColumn) {
    this.getCategories();
  }

  search(search) {
    this.searchText = search;
    this.getCategories();
  }
}