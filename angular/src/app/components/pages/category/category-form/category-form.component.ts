import { Component, OnInit, Input, ChangeDetectorRef } from '@angular/core';
import { FormGroup } from '@angular/forms';
import fieldsOptions from './category-fields-options';

@Component({
  selector: 'category-form',
  templateUrl: './category-form.component.html',
  styleUrls: ['./category-form.component.css']
})
export class CategoryFormComponent implements OnInit {
  
  @Input()
  form: FormGroup;
  
  constructor(private changeRef: ChangeDetectorRef) { }

  ngOnInit(): void {
  }

  ngOnChanges() {
    this.changeRef.detectChanges();
  }

  get fieldsOptions(): any {
    return fieldsOptions;
  }

  /**
   * dica do professor, então no category-form.component.html ficaria
   * <label [for]="name.id">{{ fieldsOptions.name.label }}</label>
   * ao invés de
   * <label [for]="fieldsOptions.name.id">{{ fieldsOptions.name.label }}</label>
   */
  // get name() {
  //   return this.fieldsOptions.name;
  // }

}
