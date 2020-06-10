import { FieldsOptions } from 'src/app/common/fields-options'

const fieldsOptions: FieldsOptions = {
	name: {
		id: 'name',
		label: 'Nome',
		validationMessage: {
			maxlength: 255
		}
	},
	is_active: {
		id: 'is_active',
		label: 'Ativo'
	}
};

export default fieldsOptions;