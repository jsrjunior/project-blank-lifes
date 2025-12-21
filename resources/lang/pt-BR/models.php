<?php

$generics = [
    'actions' => [
        'type' => function ($name) {
            return [
                'actions' => [
                    'label' => "Tipos de $name",
                    'index' => "Lista de Tipos de $name",
                    'save' => "Salvar Tipo de $name",
                    'edit' => "Editar Tipo de $name",
                    'create' => "Criar Tipo de $name",
                    'show' => "Visualizar Tipo de $name",
                    'success' => [
                        'created' => 'Tipo criado.',
                        'updated' => 'Tipo atualizado.',
                        'deleted' => 'Tipo apagado.',
                        'restored' => 'Tipo restaurado.',
                    ],
                ],
            ];
        },
        'generic' => function ($name, $singleName) {
            return [
                'actions' => [
                    'label' => "$name",
                    'index' => "Lista de $name",
                    'save' => "Salvar $singleName",
                    'edit' => "Editar $singleName",
                    'create' => "Criar $singleName",
                    'show' => "Visualizar $singleName",
                    'success' => [
                        'created' => "$singleName criado.",
                        'updated' => "$singleName atualizado.",
                        'deleted' => "$singleName apagado.",
                        'restored' => "$singleName restaurado.",
                    ],
                ],
            ];
        }
    ]
];

return [
    /*
    |--------------------------------------------------------------------------
    | Custom Models Attributes
    |--------------------------------------------------------------------------
    */

    'App\\Models\\User' => [
        'name' => 'Usuário',
        'attributes' => [
            'roles' => 'Papéis',
            'user_profile' => 'Perfil',
            'agents' => 'Unidades de negócio / Agências',
            'on_vacation' => 'Usuário de Férias',
            'is_active' => 'Ativo!',
            'end_date' => 'Data de Fim',
            'start_date' => 'Data de Início',
            'last_login' => 'Último Login',
            'type' => 'Tipo',
            'evolvy_user_token' => 'ID Caixa de Disparo Evolvy',
            'options' => [
                'type' => [
                    'EXTERNAL' => 'Externo',
                    'INTERNAL' => 'Interno',
                ],
            ],
        ],
        'actions' => [
            'label' => 'Usuários',
            'index' => 'Lista de usuários',
            'create' => 'Criar usuário',
            'edit' => 'Editar usuário',
            'delete' => 'Excluir usuário',
            'restore' => 'Restaurar usuário',
            'save' => 'Salvar',
            'success' => [
                'updated' => 'Usuário atualizado com sucesso!',
                'created' => 'Usuário criado com sucesso!',
                'deleted' => 'Usuário deletado com sucesso!',
                'inactivate_user' => 'Usuário inativado com sucesso!',
            ],
        ],
    ],

    'App\\Models\\Approval' => [
        'name' => 'Aprovação',
        'attributes' => [
            'id' => 'ID',
            'approvable_type' => 'Tipo de Aprovável',
            'approvalable_type' => 'Tipo de Aprovável',
            'approvable--type' => 'Tipo de Aprovação',
            // 'approvable--id' => 'Id Aprovação',
            'state' => 'Status',
            'new_data' => 'Motivo',
            'contract_id' => 'ID Contrato',
            'rolled_back_at' => 'Data de Atualização',
            'audited_by' => 'Revisado por',
            'created_at' => 'Data de Criação',
            'updated_at' => 'Data de Modificação',
            'requested_by' => 'Solicitante',
            'roles' => 'Papeis do Solicitante',
            'audited_by--roles' => 'Papeis do Revisor',
            'checkbox' => '',
        ],
        'actions' => [
            'label' => 'Aprovações',
            'index' => 'Lista de Aprovações',
            'create' => 'Criar Aprovação',
            'edit' => 'Editar Aprovação',
            'delete' => 'Excluir Aprovação',
            'restore' => 'Restaurar Aprovação',
            'save' => 'Salvar',
            'success' => [
                'updated' => 'Aprovação atualizada com sucesso!',
                'created' => 'Aprovação criada com sucesso!',
                'deleted' => 'Aprovação excluída com sucesso!',
            ],
        ],
    ],


    'App\\Models\\Workflow' => [
        'name' => 'Fluxo de Trabalho',
        'attributes' => [
            'status' => 'Status',
            'owner' => 'Proprietário',
            'created_at' => 'Data de Criação',
            'updated_at' => 'Data de Atualização',
            'priority' => 'Prioridade',
            'deadline' => 'Prazo Final',
            'description' => 'Descrição',
            'before_or_after' => 'Antes ou Depois',
            'roles' => 'Papeis',
            'workflow--type' => 'WorkFlow Para',
            'workflow_type' => 'WorkFlow Para',
            'subject_type' => 'WorkFlow De'
        ],
        'actions' => [
            'label' => 'Fluxos de Trabalho',
            'index' => 'Lista de Fluxos de Trabalho',
            'create' => 'Criar Fluxo de Trabalho',
            'edit' => 'Editar Fluxo de Trabalho',
            'delete' => 'Excluir Fluxo de Trabalho',
            'restore' => 'Restaurar Fluxo de Trabalho',
            'save' => 'Salvar',
            'success' => [
                'updated' => 'Fluxo de Trabalho atualizado com sucesso!',
                'created' => 'Fluxo de Trabalho criado com sucesso!',
                'deleted' => 'Fluxo de Trabalho excluído com sucesso!',
            ],
        ],
    ],


    'App\\Models\\UserProfile' => [
        'actions' => [
            'label' => 'Perfis',
            'index' => 'Lista de Perfis',
            'create' => 'Criar perfil',
            'edit' => 'Editar perfil',
            'delete' => 'Excluir perfil',
            'restore' => 'Restaurar perfil',
        ],
    ],

    'App\\Models\\Relative' => [
        'name' => 'Parente',
    ],

    'App\\Models\\UserSector' => [
        'attributes' => [
            'roles' => 'Papéis',
        ],
        'actions' => [
            'label' => 'Setores',
            'index' => 'Lista de setores',
            'create' => 'Criar setor',
            'edit' => 'Editar setor',
            'delete' => 'Excluir setor',
            'restore' => 'Restaurar setor',
            'save' => 'Salvar alterações',
            'updated' => 'Papel atualizado.',
            'success' => [
                'created' => 'Setor criado.',
                'updated' => 'Setor atualizado.',
                'deleted' => 'Setor apagado.',
                'restored' => 'Setor restaurado.',
            ],
        ],
    ],

    'App\\Models\\Role' => [
        'attributes' => [
            'permissions' => 'Permissões',
            'users' => 'Usuários',
            'userSectors' => 'Setores',
        ],
        'actions' => [
            'label' => 'Papéis',
            'index' => 'Lista de papéis',
            'create' => 'Criar papel',
            'edit' => 'Editar papel',
            'delete' => 'Excluir papel',
            'restore' => 'Restaurar papel',
            'save' => 'Salvar alterações',
            'updated' => 'Papel atualizado.',
            'success' => [
                'created' => 'Papel criado.',
                'updated' => 'Papel atualizado.',
                'deleted' => 'Papel apagado.',
                'restored' => 'Papel restaurado.',
            ],
        ],
    ],

    'App\\Models\\ClaimType' => [
        'attributes' => [
            'url_import_model' => 'Sufixo da rota',
        ],
        'actions' => [
            'label' => 'Tipos de importação',
            'index' => 'Lista dos tipos de importação',
        ],
    ],

    'App\\Models\\PaymentCompany' => [
        'attributes' => [
            'default' => 'Principal?',
        ],
    ],

    'App\\Models\\PaymentCompanyLog' => [
        'actions' => [
            'label' => 'Provedor de Pagamento',
        ],
    ],

    'App\\Models\\ImportType' => [
        'attributes' => [
            'users--name' => 'Usuário',
            'import_types--name' =>  'Tipo de Importação',
            'scheduled_at' => 'Início Importação',
            'progress_bar' => 'Progresso',
            'consent_required' => 'LGPD',
            'json_data' => 'Campos',
            'options' => [
                'status' => [
                    'created' => 'Criado',
                    'pending' => 'Executando',
                    'success' => 'Sucesso',
                    'failed' => 'Falha',
                ],

            ],
            'function' => 'Função Responsável por processar a importação',
            'size' => 'Tamanho',
            'file' => 'Arquivo',
            'import_type_id' => 'Tipo de importação',
            'legal_basis' => 'Base Legal',
        ],
        'actions' => [
            'label' => 'Tipos de Importação',
            'index' => 'Lista de importação',
            'import' => 'Novo Tipo de importação',
            'create' => 'Criar Tipo de Impoortação',
            'success' => [
                'imported' => 'Tipo de Importação criado.',
            ],
        ],
    ],

    'App\\Models\\Import' => [
        'attributes' => [
            'users--name' => 'Usuário',
            'import_types--name' =>  'Tipo de Importação',
            'scheduled_at' => 'Início Importação',
            'progress_bar' => 'Progresso',
            'options' => [
                'status' => [
                    'created' => 'Criado',
                    'pending' => 'Executando',
                    'success' => 'Sucesso',
                    'failed' => 'Falha',
                    'canceled' => 'Cancelado',
                ],
                'legal_basis' => [
                    'consent' => 'Consentimento',
                    'compliance_legal_or_regulatory_obligation' => 'Cumprimento de Obrigação Legal ou Regulatória',
                    'contract_execution' => 'Execução de Contrato',
                    'regular_exercise_of_rights_in_judicial_administrative_or_arbitration_proceedings' => 'Exercício Regular de Direitos em Processo Judicial, Administrativo ou Arbitral',
                    'protection_life_or_physical_safety' => 'Proteção da Vida ou da Incolumidade Física',
                    'health_protection' => 'Tutela da Saúde',
                    'legitimate_interest' => 'Interesse Legítimo',
                    'ensuring_fraud_prevention_and_compliance_with_legal_obligations' => 'Garantia da Prevenção de Fraudes e Cumprimento de Obrigações Legais',
                    'credit_protection' => 'Proteção do Crédito',
                    'scientific_or_statistical_research' => 'Pesquisa Científica ou Estatística',
                ],

                'legal_basis_all' => [
                    'consent' => 'Consentimento: O tratamento de dados pessoais é permitido quando o titular dos dados fornece seu consentimento específico e informado para essa finalidade. O consentimento deve ser obtido de forma clara e inequívoca.',
                    'compliance_legal_or_regulatory_obligation' => 'Cumprimento de Obrigação Legal ou Regulatória: O tratamento de dados pessoais é autorizado quando necessário para o cumprimento de uma obrigação legal ou regulatória pelo controlador de dados.',
                    'contract_execution' => 'Execução de Contrato: O tratamento de dados é permitido quando necessário para a execução de um contrato do qual o titular dos dados seja parte ou para a realização de medidas pré-contratuais a pedido do titular.',
                    'regular_exercise_of_rights_in_judicial_administrative_or_arbitration_proceedings' => 'Exercício Regular de Direitos em Processo Judicial, Administrativo ou Arbitral: O tratamento de dados pessoais pode ocorrer quando necessário para o exercício regular de direitos em processos judiciais, administrativos ou arbitrais.',
                    'protection_life_or_physical_safety' => 'Proteção da Vida ou da Incolumidade Física: O tratamento de dados pessoais é autorizado para proteger a vida ou a integridade física do titular dos dados ou de terceiros.',
                    'health_protection' => 'Tutela da Saúde: O tratamento de dados pessoais é permitido para fins de tutela da saúde, incluindo o tratamento de informações de saúde.',
                    'legitimate_interest' => 'Interesse Legítimo: O tratamento de dados pessoais é permitido com base em um interesse legítimo do controlador de dados, desde que esse interesse não prejudique os direitos e liberdades fundamentais do titular dos dados.',
                    'ensuring_fraud_prevention_and_compliance_with_legal_obligations' => 'Garantia da Prevenção de Fraudes e Cumprimento de Obrigações Legais: Os dados pessoais podem ser tratados para a garantia da prevenção de fraudes e para o cumprimento de obrigações legais do controlador.',
                    'credit_protection' => 'Proteção do Crédito: O tratamento de dados pessoais é permitido para a proteção do crédito, incluindo análises de crédito.',
                    'scientific_or_statistical_research' => 'Pesquisa Científica ou Estatística: Dados pessoais podem ser utilizados para pesquisa científica ou estatística, desde que seja anonimizado ou obtido o consentimento quando necessário.',
                ],
            ],
            'model' => 'Seção',
            'size' => 'Tamanho',
            'file' => 'Arquivo',
            'import_type_id' => 'Tipo de importação',
            'legal_basis' => 'Base Legal',
        ],
        'actions' => [
            'label' => 'Importações',
            'index' => 'Lista de importações',
            'import' => 'Nova importação',
            'create' => 'Importar',
            'success' => [
                'imported' => 'Importação criada.',
            ],
        ],
    ],

    'App\\Models\\Indication' => [
        'attributes' => [
            'customer--people--name' => 'Nome do cliente',
            'options' => [
                'status' => [
                    'indication_made' => 'Nova indicação',
                    'under_negotiation' => 'Em tratativa',
                    'hired' => 'Contratou',
                    'given_up' => 'Desistiu',
                    'canceled' => 'Cancelou',
                    'not_hired' => 'Não contratou',
                ],
                'financial_status' => [
                    'waiting_first_payment' => 'Aguardando 1º pagamento',
                    'waiting_second_payment' => 'Aguardando 2º pagamento',
                    'waiting_third_payment' => 'Aguardando 3º pagamento',
                    'awaiting_reward' => 'Aguardando a recompensa',
                    'reward_granted' => 'Recompensa realizada',
                ],
                'bonus' => [
                    'money' => 'Dinheiro',
                    'medication_plan' => 'Plano medicamentos',
                    'discount_plan' => 'Plano desconto em consultas e exames',
                    'residential_assistance' => 'Assistência Residencial',
                    'credit_benefict' => 'Credito Beneficio Social',
                ],
                'product' => [
                    'pff' => 'Plano funerário familiar',
                    'bensoc' => 'Benefício social',
                ]
            ]
        ],
        'actions' => [
            'label' => 'Indicação',
        ],
    ],

    'App\\Models\\Fee' => [
        'name' => 'Taxa',
    ],

    'App\\Models\\FeatureTag' => [
        'attributes' => [
            'slug' => 'slug',
            'reason' => 'Motivo',
            'description' => 'Descrição',
            'active' => 'Status',
            'created_at' => 'Data de Criação',
            'updated_at' => 'Data de Alteração',
        ],
        'actions' => [
            'label' => 'Features',
            'index' => 'Lista de Features',
            'save' => 'Salvar Feature',
            'edit' => 'Editar Feature',
            'show' => 'Visualizar Feature',
            'success' => [
                'created' => 'Feature Criada',
                'updated' => 'Feature Atualizada.',
                'deleted' => 'Feature Deletada.',
                'restored' => 'Feature restaurada.',
            ],
        ],
    ],

    'App\\Moddels\\ContractSettingTag' => [
        'attributes' => [
            'slug' => 'slug',
            'reason' => 'Motivo',
            'description' => 'Descrição',
            'active' => 'Status',
            'created_at' => 'Data de Criação',
            'updated_at' => 'Data de Alteração',
        ],
        'actions' => [
            'label' => 'Features de Contrato',
            'index' => 'Lista de Features de Contrato',
            'save' => 'Salvar Feature de Contrato',
            'edit' => 'Editar Feature de Contrato',
            'show' => 'Visualizar Feature de Contrato',
            'success' => [
                'created' => 'Feature de Contrato Criada',
                'updated' => 'Feature de Contrato Atualizada.',
                'deleted' => 'Feature de Contrato Deletada.',
                'restored' => 'Feature de Contrato restaurada.',
            ],
        ],
    ],

    'App\\Models\\Export' => [
        'attributes' => [
            'users--name' => 'Usuário',
            'options' => [
                'status' => [
                    'created' => 'Criado',
                    'pending' => 'Executando',
                    'success' => 'Sucesso',
                    'failed' => 'Falha',
                ],
            ],
            'model' => 'Seção',
            'size' => 'Tamanho',
        ],
        'actions' => [
            'label' => 'Exportações',
            'index' => 'Lista de exportações',
        ],
    ],

    'App\\Models\\Contract' => [
        'name' => 'Contrato',
        'attributes' => [
            'id' => 'CTT',
            'customer--people--name' => 'Titular (anjo da guarda)',
            'customer--people--person_profiles--birth_date_age_formated' => 'Idade',
            'customer--people--email--email' => 'Email',
            'subscription--subscription_status' => 'Situação',
            'subscription--plan--title' => 'Coberturas',
            'plan_title_master' => 'Título do plano master',
            'payment_day' => 'Ciclo',
            'user_id' => 'Vendedor',
            'contract_status_id' => 'Status Financeiro',
            'contract_origin_id' => 'Origem da Contratação',
            'upgraded_at' => 'Data de atualização',
            'canceled_at' => 'Data de cancelamento',
            'start_at' => 'Data de início',
            'end_at' => 'Data de término',
            'payment_method--name' => 'Método de pagamento',
            'contract_status--name' => 'Status do contrato',
            'agency--fantasy_name' => 'Agência',
            'vehicle--plate' => 'Placa do veículo',
            'payment_company--name' => 'Companhia de pagamento',
            'dependents--person--full_name' => 'Nomes dos dependentes',
            'dependents--person--first_name' => 'Primeiros nomes dos dependentes',
            'contract_origin--name' => 'Origem do contrato',
            'subscriptions--subscription_status--name' => 'Status das assinaturas',
            'subscriptions--plan--title' => 'Coberturas',
            'next_billing_date' => 'Data da próxima cobrança',
            'add_new_card' => 'Link para adicionar novo cartão',
            'bank_slip_latest_invoice' => 'Código de barras',
        ],
        'actions' => [
            'label' => 'Contrato',
            'index' => 'Lista de contratos',
            'save' => 'Salvar contrato',
            'edit' => 'Editar contrato',
            'create' => 'Criar contrato',
            'show' => 'Visualizar contratos',
            'success' => [
                'created' => 'Contrato criado.',
                'updated' => 'Contrato atualizado.',
                'deleted' => 'Contrato apagado.',
                'restored' => 'Contrato restaurado.',
                'cancel_contract' => 'Contrato cancelado.',
                'zero_care' => 'Carência zerada.',
                'crown_flower_added' => 'Coroa de flores adicionada.',
                'duplicated_invoices' => 'Faturas duplicadas canceladas.',
                'duplicated_subscriptions' => 'Assinaturas duplicadas canceladas.',
            ],
        ],
    ],

    'App\\Models\\ContractDocument' => [
        'attributes' => [
            'file_path' => 'Documento',
            'contract_document_types--name' => 'Tipo',
            'users--name' => 'Usuario',
            'created_at' => 'Data da Criação',
            'contract_document_type_id' => 'Tipo',
            'user_id' => 'Usuario',
            'contract_id' => 'Contrato'
        ],
        'actions' => [
            'label' => 'Anexos de Contrato',
            'index' => 'Lista de Anexos',
            'save' => 'Salvar Anexo',
            'edit' => 'Editar Anexo',
            'show' => 'Visualizar Anexo',
            'success' => [
                'created' => 'Anexado.',
                'updated' => 'Anexo atualizado.',
                'deleted' => 'Anexo apagado.',
                'restored' => 'Anexo restaurado.',
            ],
        ],
    ],

    'App\\Models\\ContractInteraction' => [
        'attributes' => [
            'contract_id' => 'Contrato',
            'contract_interaction_type_id' => 'Tipo de Interação',
            'contract_interaction_status_id' => 'Status',
            'user_id' => 'Usuário',
            'users--name' => 'Responsável',
            'note' => 'Nota da Interação',
            'description' => 'Descrição da Interação',
            'deadline' => 'Prazo',
            'id' => 'Protocolo',
            'contract_interaction_id' => 'Protocolo',
            'user_id' => 'Usuário',
            'users--name' => 'Atendente',
            'contract_interaction_not_pay_statuses--name' => 'Status Pagamento',
            'contract_interaction_sub_statuses--name' => 'Status',
            'contract_interaction_channels--name' => 'Canal',
            'contract_interaction_sub_status_id' => 'Substatus de Interação de Contrato',
            'contract_interaction_channel_id' => 'Canal de Interação de Contrato',
            'contract_interaction_not_pay_status_id' => 'Status de Não Pagamento de Interação de Contrato',
            'contract_interaction_description_id' => 'id da descrição',
            'description' => 'Descrição do Histórico de Interação',
            'negociated' => 'Negociado',
            'notificated' => 'Notificado',
            'deadline' => 'Prazo',
        ],
        'actions' => [
            'label' => 'Interações de Contrato',
            'index' => 'Lista de Interações de Contrato',
            'save' => 'Salvar Interação de Contrato',
            'edit' => 'Editar Interação de Contrato',
            'create' => 'Nova Interação',
            'show' => 'Visualizar Interação de Contrato',
            'success' => [
                'created' => 'Interação de Contrato criada.',
                'updated' => 'Interação de Contrato atualizada.',
                'deleted' => 'Interação de Contrato apagada.',
                'restored' => 'Interação de Contrato restaurada.',
            ],
        ],
    ],

    'App\\Models\\ContractInteractionHistory' => [
        'attributes' => [
            'contract_interaction_id' => 'Protocolo',
            'user_id' => 'Usuário',
            'users--name' => 'Atendente',
            'contract_interaction_not_pay_statuses--name' => 'Status Pagamento',
            'contract_interaction_sub_statuses--name' => 'Status',
            'contract_interaction_channels--name' => 'Canal',
            'contract_interaction_sub_status_id' => 'Substatus de Interação de Contrato',
            'contract_interaction_channel_id' => 'Canal de Interação de Contrato',
            'contract_interaction_not_pay_status_id' => 'Status de Não Pagamento de Interação de Contrato',
            'contract_interaction_description_id' => 'id da descrição',
            'description' => 'Descrição do Histórico de Interação',
            'negociated' => 'Negociado',
            'notificated' => 'Notificado',
            'deadline' => 'Prazo',
        ],
        'actions' => [
            'label' => 'Histórico de Interações de Contrato',
            'index' => 'Lista de Histórico de Interações de Contrato',
            'save' => 'Salvar Histórico de Interação de Contrato',
            'edit' => 'Editar Histórico de Interação de Contrato',
            'create' => 'Criar Histórico de Interação de Contrato',
            'show' => 'Visualizar Histórico de Interação de Contrato',
            'success' => [
                'created' => 'Histórico de Interação de Contrato criado.',
                'updated' => 'Histórico de Interação de Contrato atualizado.',
                'deleted' => 'Histórico de Interação de Contrato apagado.',
                'restored' => 'Histórico de Interação de Contrato restaurado.',
            ],
        ],
    ],

    'App\\Models\\InvoiceStatus' => [
        'attributes' => [
            'is_countable' => 'Considera para contabilizar ciclo?',
            'is_open' => 'Considera status como aberto?',
        ],
        'actions' => [
            'label' => 'Status da fatura',
            'index' => 'Lista de status da fatura',
            'save' => 'Salvar status da fatura',
            'edit' => 'Editar status da fatura',
            'create' => 'Criar status da fatura',
            'show' => 'Visualizar status da fatura',
            'success' => [
                'created' => 'Status da fatura criada.',
                'updated' => 'Status da fatura atualizada.',
                'deleted' => 'Status da fatura apagada.',
                'restored' => 'Status da fatura restaurada.',
            ],
        ],
    ],

    'App\\Models\\TargetCall' => [
        'attributes' => [
            'role_id' => 'Papel',
            'roles' => 'Papeis',
            'name' => 'Nome',
            'description' => 'Descrição',
            'value' => 'Valor',
        ],
        'actions' => [
            'label' => 'Metas de chamadas',
            'index' => 'Lista de metas de chamadas',
            'save' => 'Salvar metas de chamadas',
            'edit' => 'Editar metas de chamadas',
            'create' => 'Criar metas de chamadas',
            'show' => 'Visualizar metas de chamadas',
            'success' => [
                'created' => 'Meta de chamada criada.',
                'updated' => 'Meta de chamada atualizada.',
                'deleted' => 'Meta de chamada apagada.',
                'restored' => 'Meta de chamada restaurada.',
            ],
        ],
    ],

    'App\\Models\\TargetSegmentation' => [
        'attributes' => [
            'name' => 'Nome',
            'description' => 'Descrição',
            'value' => 'Valor',
            'segmentation_id' => 'Segmentação',
            'segmentation--name' => 'Segmentação',
        ],
        'actions' => [
            'label' => 'Metas de segmentações',
            'index' => 'Lista de metas de segmentações',
            'save' => 'Salvar metas de segmentações',
            'edit' => 'Editar metas de segmentações',
            'create' => 'Criar metas de segmentações',
            'show' => 'Visualizar metas de segmentações',
            'success' => [
                'created' => 'Meta de segmentação criada.',
                'updated' => 'Meta de segmentação atualizada.',
                'deleted' => 'Meta de segmentação apagada.',
                'restored' => 'Meta de segmentação restaurada.',
            ],
        ],
    ],
    'App\\Models\\Promotion' => [
        'attributes' => [
            'name' => 'Nome',
            'desciption' => "Descrição",
            'award' => 'Prêmio',
            'type_promotion_id' => 'Tipo de Promoção',
            'start_at' => 'Inicio da Promoção',
            'end_at' => 'Fim da Promoção',
        ],
        'actions' => [
            'index' => 'Lista de Promoções',
            'save' => 'Salvar Promoção',
            'edit' => 'Editar Promoção',
            'create' => 'Criar Promoção',
            'show' => 'Visualizar Promoção',
            'success' => [
                'created' => 'Promoção criada.',
                'updated' => 'Promoção atualizada.',
                'deleted' => 'Promoção apagada.',
                'restored' => 'Promoção restaurada.',
            ],
        ],
    ],
    'App\\Models\\PromotionParticipant' => [
        'attributes' => [
            'full_name' => 'Nome',
            'person_id' => 'Pessoa',
            'arroba' => 'Arroba',
            'cpf' => 'Documento CPF',
            'promotion_id' => 'Promoção',
            'phrase' => 'Frase',
            'lucky_number' => 'Numero da Sorte',
            'registration_at' => 'Data de Registro'
        ],
        'actions' => [
            'index' => 'Lista de Promoções',
            'show' => 'Visualizar Promoção',
            'success' => [
                'created' => 'Promoção criada.',
                'updated' => 'Promoção atualizada.',
                'deleted' => 'Promoção apagada.',
                'restored' => 'Promoção restaurada.',
            ],
        ],
    ],

    'App\\Models\\QueryBuilderElementType' => [
        'attributes' => [
            'name' => 'Nome',
            'description' => 'Descrição',
        ],
    ],

    'App\\Models\\QueryBuilderFilter' => [
        'attributes' => [
            'query_builder_element_type_id' => 'Tipo de Elemento',
            'name' => 'Nome',
            'description' => 'Descrição',
            'model' => 'Modelo',
            'attribute' => 'Atributo',
            'model_option_type' => 'Tipo de Opção de Modelo',
            'model_option' => 'Opção de Modelo',
            'model_option_condition' => 'Condição de Opção de Modelo',
            'model_option_group' => 'Grupo de Opção de Modelo',
            'model_option_order' => 'Ordem de Opção de Modelo',
        ],
    ],

    'App\\Models\\QueryBuilderAttributeConditional' => [
        'name' => 'Condição',
        'description' => 'Descrição',
        'operator' => 'Operador',
    ],

    'App\\Models\\QueryBuilderConfiguration' => [
        'attributes' => [
            'query_builder_filter_id' => 'Filtro',
            'segmentation_id' => 'Segmentação',
            'query_builder_attribute_conditional_id' => 'Condição',
            'selected_filter_options' => 'Opções selecionadas',
        ],
        'actions' => [
            'label' => 'Regras para segmentação',
            'index' => 'Lista das regras para segmentação',
            'save' => 'Salvar regras para segmentação',
            'edit' => 'Editar regras para segmentação',
            'create' => 'Criar regras para segmentação',
            'show' => 'Visualizar regras para segmentação',
            'success' => [
                'created' => 'Regras para segmentação criada.',
                'updated' => 'Regras para segmentação atualizada.',
                'deleted' => 'Regras para segmentação apagada.',
                'restored' => 'Regras para segmentação restaurada.',
            ],
        ],
    ],

    'App\\Models\\SegmentationTeam' => [
        'attributes' => [
            'users' => 'Usuários',
            'segmentations' => 'Segmentações'
        ],
        'actions' => [
            'label' => 'Times',
            'index' => 'Lista de times para segmentação',
            'save' => 'Salvar time',
            'edit' => 'Editar time',
            'create' => 'Criar time',
            'show' => 'Visualizar time',
            'success' => [
                'created' => 'Time criado.',
                'updated' => 'Time atualizado.',
                'deleted' => 'Time apagado.',
                'restored' => 'Time restaurado.',
            ],
        ],
    ],

    'App\\Models\\Segmentation' => [
        'attributes' => [
            'segmentation_team_id' => 'Time',
            'segmentationTeams' => 'Time',
            'name' => 'Nome',
            'description' => 'Descrição',
            'segmentation_status_id' => 'Status',
            'segmentation_status' => 'Status',
            'segmentation_progress' => 'Progresso/Atualização',
            'is_ia_flag' => 'Segmentar para I.A',
            'options' => [
                'type' => [
                    'LEGAL' => 'Jurídico',
                    'CONTRACT' => 'Contrato',
                ],
            ],
            'contract_valid' => 'Contrato válido',
            'contract_late_installments' => 'Quantidade de ciclos vencidos',
            'contract_paid_installments' => 'Quantidade de ciclos pagos',
            'contract_pending_installments' => 'Dias em atraso',
            'charge_late_days' => 'Dias em atraso',
            'invoice_late_days' => 'Dias em atraso (vencimento original)',
            'invoice_to_due_days' => 'Dias antes de vencer (vencimento original)',
            'contract_cycles' => 'Ciclos',
            'charge_payment_method' => 'Forma de pagamento',
            'charge_last_interaction' => 'Última interação',
            'invoice_subscription_statuses' => 'Status do contrato',
            'invoice_subscription_plans' => 'Modalidade',
            'claim_death' => 'Óbito',
            'claim_death_holder' => 'Óbito do titular',
            'claim_death_attended' => 'Óbito atendido',
            'person_profile_documents' => 'Tipo de pessoa',
            'person_addresses_state' => 'Estado',
            'customer_communication_preferences' => 'Bloqueio de todas as comunicações?',
            'contract_remove_interactions_date[]' => 'Remover interagidos por data',
            'contract_interactions' => 'Quantidade de interações',
            'contract_canceled_at[]' => 'Cancelamento Contrato',
            'contract_user' => 'Vendedor',
            'contract_start_at' => 'Mês de ínicio do contrato',
            'contract_products' => 'Taxas, produtos e serviços',
            'contract_payment_method' => 'Forma de pagamento',
            'contract_status' => 'Status financeiro',
            'invoice_attempts' => 'Tentativas de pagamento',
            'legal_suspension_level' => 'Fase',
            'legal_suspension_involved' => 'Parte',
            'legal_suspension_status' => 'Status',
            'legal_suspension_date' => 'Data',
            'charge_qtd_interactions' => 'Quantidade de interações (financeira)',
            'contract_qtd_interactions' => 'Quantidade de interações (contrato)',
            'invoice_remove_extended_date' => 'Remover Prorrogados',
            'canceled_contract' => 'Data de Cancelamento'
        ],
        'actions' => [
            'label' => 'Segmentações',
            'index' => 'Lista de segmentações',
            'save' => 'Salvar segmentações',
            'edit' => 'Editar segmentações',
            'create' => 'Criar segmentações',
            'show' => 'Visualizar segmentações',
            'success' => [
                'created' => 'Segmentação criada.',
                'updated' => 'Segmentação atualizada.',
                'deleted' => 'Segmentação apagada.',
                'restored' => 'Segmentação restaurada.',
            ],
        ],
    ],

    'App\\Models\\SegmentationStatus' => [
        'actions' => [
            'label' => 'Status da segmentação',
            'index' => 'Lista de status da segmentação',
            'save' => 'Salvar status da segmentação',
            'edit' => 'Editar status da segmentação',
            'create' => 'Criar status da segmentação',
            'show' => 'Visualizar status da segmentação',
            'success' => [
                'created' => 'Status da segmentação criada.',
                'updated' => 'Status da segmentação atualizada.',
                'deleted' => 'Status da segmentação apagada.',
                'restored' => 'Status da segmentação restaurada.',
            ],
        ],
    ],

    'App\\Models\\LegalSuspension' => [
        'actions' => [
            'label' => 'Suspensões jurídicas',
        ],
        'attributes' => [
            'contract_id' => 'Contrato',
            'customer--people--name' => 'Titular',
            'is_legal' => 'Acordo',
            'date' => 'Data da suspensão',
            'legal_suspension_status--name' => 'Status',
            'legal_involved--name' => 'Parte',
            'legal_identification--name' => 'Identificação',
            'legal_suspension_type--name' => 'Tipo',
            'ligitation--ligitation_situation--name' => 'Situação',
        ],
    ],

    'App\\Models\\InvoiceAttempt' => [
        'actions' => [
            'label' => 'Retentativas de cobrança',
            'index' => 'Lista de retentativas',
            'save' => 'Salvar retentativa',
            'edit' => 'Editar retentativa',
            'create' => 'Criar retentativa',
            'show' => 'Visualizar retentativa',
            'success' => [
                'created' => 'Retentativa criada.',
                'updated' => 'Retentativa atualizada.',
                'deleted' => 'Retentativa apagada.',
                'restored' => 'Retentativa restaurada.',
            ],
        ],
    ],

    'App\\Models\\Invoice' => [
        'attributes' => [
            'carnival_date' => 'Data do carnaval do ano da fatura',
            'contract_id' => 'Contrato',
            'invoice_statuses--name' => 'Status',
            'period_start_at' => 'Período inicial',
            'period_end_at' => 'Período final',
            'original_due_at' => 'Vencimento original',
            'default' => 'Principal?',
            'competence' => 'Competência',
            'latest_invoice_charge_payment_company_name' => 'Provedor de pagamento',
            'latest_invoice_charge_payment_method_name' => 'Forma de pagamento',
            'latest_invoice_charge_amount' => 'Valor',
            'latest_invoice_charge_paid_at' => 'Data de pagamento',
            'original_due_at' => 'Vencimento original',
            'customer--person--first_name' => 'Primeiro Nome do cliente',
            'customer--person--address' => 'Endereço do cliente',
            'latest_invoice_charge_payment--company_name' => 'Companhia de pagamento da última cobrança',
            'latest_invoice_charge_payment--method_name' => 'Método de pagamento da última cobrança',
            'latest_invoice_charge--amount' => 'Valor da última fatura',
            'latest_invoice_charge--paid_at' => 'Data do pagamento da última fatura',
            'latest_invoice_charge--due_at' => 'Data de vencimento da última fatura',
            'latest_invoice_charge--slip_code' => 'Código de barra',
            'latest_invoice_charge--external_bill_url' => 'Link para boleto',
            'latest_invoice_charge--payment_method--name' => 'Método de pagamento',
            'plan_title' => 'Título da cobertura',
            'competence_month' => 'Mês de competência',
        ],
        'actions' => [
            'label' => 'Fatura',
            'index' => 'Lista de fatura',
            'save' => 'Salvar fatura',
            'edit' => 'Editar fatura',
            'create' => 'Criar fatura',
            'show' => 'Visualizar fatura',
            'success' => [
                'created' => 'Fatura criada.',
                'updated' => 'Fatura atualizada.',
                'deleted' => 'Fatura apagada.',
                'restored' => 'Fatura restaurada.',
                'late_invoice' => 'Fatura atrasada',
                'reminder' => 'Lembrete enviado para o cliente',
            ],
        ],
    ],

    'App\\Models\\DiscountRule' => [
        'attributes' => [
            'alert_message' => 'Mensagem de alerta',
            'amount' => 'Limite (porcentagem)',
        ],
        'actions' => [
            'label' => 'Configuração de descontos',
            'index' => 'Lista de configurações',
            'save' => 'Salvar configurações',
            'edit' => 'Editar configurações',
            'create' => 'Criar configurações',
            'show' => 'Visualizar configurações',
            'success' => [
                'created' => 'Configuração de descontos criada.',
                'updated' => 'Configuração de descontos atualizada.',
                'deleted' => 'Configuração de descontos apagada.',
                'restored' => 'Configuração de descontos restaurada.',
            ],
        ],
    ],

    'App\\Models\\Customer' => [
        'attributes' => [
            'people--fullName' => 'Nome',
            'people--first_name' => 'Nome',
            'people--last_name' => 'Sobrenome',
            'customer_statuses--name' => 'Status',
            'people--emails--email' => 'E-mail',
            'people--phones--phone' => 'Telefone',
            'people--person_profiles--person_profile_documents--formated_document' => 'Documento',
            'add_new_card' => 'Link para adicionar novo cartão',
        ],
        'actions' => [
            'label' => 'Contas',
            'index' => 'Lista de contas',
            'save' => 'Salvar contas',
            'edit' => 'Editar contas',
            'create' => 'Criar conta',
            'show' => 'Visualizar contas',
            'success' => [
                'created' => 'Conta criada.',
                'updated' => 'Conta atualizada.',
                'deleted' => 'Conta apagada.',
                'restored' => 'Conta restaurada.',
            ],
        ],
    ],

    'App\\Models\\Agency' => [
        'attributes' => [
            'people--first_name' => 'Nome social',
            'first_name' => 'Nome social',
            'people--person_profiles--person_profile_documents--formated_document' => 'CNPJ',
            'fantasy_name' => 'Nome Fantasia',
            'agents' => 'Usuários / Agentes / Responsáveis',
            'planSubCategories' => 'Planos Vendidos',
            'restrict_plans' => 'Modalidades que não devem ser vendidas'
        ],
        'actions' => [
            'label' => 'Agências',
            'index' => 'Lista de agências',
            'save' => 'Salvar Agência',
            'edit' => 'Editar Agência',
            'create' => 'Criar Agência',
            'show' => 'Visualizar Agência',
            'success' => [
                'created' => 'Agência criada.',
                'updated' => 'Agência atualizada.',
                'deleted' => 'Agência apagada.',
                'restored' => 'Agência restaurada.',
            ],
        ],
    ],

    'App\\Models\\Contact' => [
        'name' => 'Contato',
        'attributes' => [
            'subject' => 'Assunto',

            'options' => [
                'subjects' => [
                    'doubts' => 'Dúvidas',
                    'compliment' => 'Elogio',
                    'payment' => 'Pagamento',
                    'complaint' => 'Reclamação',
                    'sales' => 'Vendas',
                    'solicitation' => 'Solicitação',
                ],
            ],
        ],
    ],

    'App\\Models\\Advertisement' => [
        'attributes' => [
            'is_active' => 'Ativo',
            'has_priority' => 'Exibir com prioridade',
            'code' => 'Código',
            'sizes' => 'Tamanho',
            'hide_from_lifetime' => 'Não exibir para vitalícios',
            'options' => [
                'type' => [
                    'in_text' => 'Native',
                    'popup' => 'Popup',
                    'side_banner' => 'Banner Lateral',
                    'top_banner' => 'Banner Topo',
                    'ad_native_nl' => 'Ad Native NL',
                    'outside_layout_nl' => 'Fora do layout NL',
                    'ps_nl' => 'PS NL',
                    'editors_note_nl' => 'Nota do editor NL',
                ],
                'sizes' => [
                    '728x90' => '728x90',
                    '336x280' => '336x280',
                    '300x250' => '300x250',
                    '160x600' => '160x600',
                ],
            ],
            'hide_unpublished' => 'Esconder não publicados',
        ],
        'actions' => [
            'label' => 'Advertisements',
            'index' => 'Lista de advertisements',
            'create' => 'Criar advertisement',
            'edit' => 'Editar advertisement',
            'delete' => 'Excluir advertisement',
            'restore' => 'Restaurar advertisement',
        ],
    ],

    'App\\Models\\Message' => [
        'attributes' => [
            'hide_from_lifetime' => 'Não exibir para vitalícios',
            'total' => 'Enviadas',
            'total_read' => 'Lidas',
            'options' => [
                'status' => [
                    'created' => 'Novo',
                    'pending' => 'Enviando',
                    'failed' => 'Falha',
                    'success' => 'Sucesso',
                ],
                'recurrence' => [
                    'once' => 'Enviar uma vez',
                    'series_renew' => 'D-3 da renovação da série',
                    'content_publishing' => 'Publicação conteúdo',
                ],
            ],
            'hide_unpublished' => 'Esconder não publicados',
        ],
        'actions' => [
            'label' => 'Notificações',
            'index' => 'Lista de notificações',
            'create' => 'Criar notificação',
            'edit' => 'Editar notificação',
            'delete' => 'Excluir notificação',
            'restore' => 'Restaurar notificação',
        ],
    ],

    'App\\Models\\TemplateCategory' => [
        'name' => 'Categoria de Template',
        'attributes' => [
            'sendgrid_asm_group' => 'Sendgrid ASM Group',
            'template_type_ids' => 'Tipos de templates',
            'created_by_user_id' => 'Usuário que criou',
            'updated_by_user_id' => 'Usuário que atualizou',
        ],
        'actions' => [
            'label' => 'Categoria de Template',
            'index' => 'Lista de Categorias de Template',
            'edit' => 'Editar Categoria de Template',
            'delete' => 'Excluir Categoria de Template',
            'restore' => 'Restaurar Categoria de Template',
        ],
    ],

    'App\\Models\\TemplateClassification' => [
        'name' => 'Classificação de Template',
        'attributes' => [
            'created_by_user_id' => 'Usuário que criou',
            'updated_by_user_id' => 'Usuário que atualizou',
        ],
        'actions' => [
            'label' => 'Classificação de Template',
            'index' => 'Lista de Classificações de Template',
            'create' => 'Criar Classificação de Template',
            'edit' => 'Editar Classificação de Template',
            'delete' => 'Excluir Classificação de Template',
            'restore' => 'Restaurar Classificação de Template',
        ],
    ],

    'App\\Models\\SmsMessage' => [
        'attributes' => [
            'options' => [
                'status' => [
                    'created' => 'Novo',
                    'scheduled' => 'Agendado',
                    'failed' => 'Falha',
                    'success' => 'Sucesso',
                ],
            ],
            'content_id' => 'Edição',
            'send_at' => 'Enviar em',
            'sent_at' => 'Enviado em',
            'phone_test' => 'Telefone para teste',
        ],
        'actions' => [
            'label' => 'SMS',
            'index' => 'Lista de Mensagens SMS',
            'create' => 'Criar Mensagen SMS',
            'edit' => 'Editar Mensagen SMS',
            'delete' => 'Excluir Mensagen SMS',
            'restore' => 'Restaurar Mensagen SMS',
        ],
    ],

    'App\\Models\\EmailQueue' => [
        'attributes' => [
            'email' => 'Para',
            'template' => 'Template',
            'mail_from' => 'De',
            'account' => 'Conta',
            'options' => [
                'attachment_types' => [
                    'App\\Models\\Contract' => [
                        'latest_contract' => 'Último contrato',
                    ],
                ],
                'contract_emails' => [
                    'last_contract' => 'Enviar último contrato',
                    'updated_contract' => 'Enviar contrato atualizado',
                    'accordingly' => 'De acordo',
                    'payment_slip' => 'Enviar carnê',
                    'invoice' => 'Enviar fatura',
                ],
                'account_emails' => [
                    'password_reset' => 'Reset de senha',
                ],
                'status' => [
                    'pending' => 'Pendente',
                    'sent' => 'Enviado',
                    'failed' => 'Falha',
                ]
            ]
        ],
        'actions' => [
            'label' => 'E-mail',
            'index' => 'Lista de E-mails',
            'create' => 'Criar E-mail',
            'edit' => 'Editar E-mail',
            'delete' => 'Excluir E-mail',
            'restore' => 'Restaurar E-mail',
        ],
    ],

    'App\\Models\\NoticeDespatched' => [
        'attributes' => [
            'account' => 'Conta',
            'template' => 'Template',
            'sent_at' => 'Enviado em',
            'read_at' => 'Lido em',
        ],
        'actions' => [
            'label' => 'Avisos',
            'index' => 'Lista de Avisos',
        ],
    ],

    'App\\Models\\NoticeTemplate' => [
        'name' => 'Template de aviso',
        'attributes' => [
            'subject' => 'Título',
            'content' => 'Conteúdo',
            'template_category_id' => 'Categoria',
            'template_category' => 'Categoria',
            'created_by_user_id' => 'Usuário que criou',
            'updated_by_user_id' => 'Usuário que atualizou',
            'role_ids' => 'Papéis',
            'template_classification_ids' => 'Classificação',
            'status' => 'Status',
            'module_ids' => 'Módulos',
            'model_type' => 'Modelo relacionado',
            'model_id' => 'Escolha um id do modelo relacionado para preencher as variáveis utilizadas no aviso',
        ],
        'actions' => [
            'label' => 'Template de aviso',
            'index' => 'Lista de Templates de Aviso',
            'create' => 'Criar template',
            'edit' => 'Editar template',
            'delete' => 'Excluir template',
            'restore' => 'Restaurar template',
            'success' => [
                'restoredVersion' => 'Versão do template restaurada com sucesso.',
            ],
        ],
    ],

    'App\\Models\\IaTemplate' => [
        'name' => 'Template de I.A',
        'attributes' => [
            'subject' => 'Título',
            'content' => 'Conteúdo',
            'template_category_id' => 'Categoria',
            'template_category' => 'Categoria',
            'created_by_user_id' => 'Usuário que criou',
            'updated_by_user_id' => 'Usuário que atualizou',
            'role_ids' => 'Papéis',
            'template_classification_ids' => 'Classificação',
            'status' => 'Status',
            'module_ids' => 'Módulos',
            'model_type' => 'Modelo relacionado',
            'model_id' => 'Escolha um id do modelo relacionado para preencher as variáveis utilizadas no aviso',
        ],
        'actions' => [
            'label' => 'Template de I.A',
            'index' => 'Lista de Templates de I.A',
            'create' => 'Criar template',
            'edit' => 'Editar template',
            'delete' => 'Excluir template',
            'restore' => 'Restaurar template',
            'success' => [
                'restoredVersion' => 'Versão do template restaurada com sucesso.',
            ],
        ],
    ],

    'App\\Models\\NotificationDespatched' => [
        'attributes' => [
            'account' => 'Conta',
            'template' => 'Template',
            'sent_at' => 'Enviada em',
            'read_at' => 'Lida em',
        ],
        'actions' => [
            'label' => 'Notificações',
            'index' => 'Lista de Notificações',
        ],
    ],

    'App\\Models\\NotificationTemplate' => [
        'name' => 'Template de notificação',
        'attributes' => [
            'subject' => 'Título',
            'content' => 'Conteúdo',
            'button_name' => 'Nome do botão',
            'button_link' => 'Link do botão',
            'template_category_id' => 'Categoria',
            'template_category' => 'Categoria',
            'created_by_user_id' => 'Usuário que criou',
            'updated_by_user_id' => 'Usuário que atualizou',
            'role_ids' => 'Papéis',
            'template_classification_ids' => 'Classificação',
            'status' => 'Status',
            'module_ids' => 'Módulos',
            'model_type' => 'Modelo relacionado',
            'model_id' => 'Escolha um id do modelo relacionado para preencher as variáveis utilizadas na notificação',
        ],
        'actions' => [
            'label' => 'Template de notificação',
            'index' => 'Lista de Templates de Notificação',
            'create' => 'Criar template',
            'edit' => 'Editar template',
            'delete' => 'Excluir template',
            'restore' => 'Restaurar template',
            'success' => [
                'restoredVersion' => 'Versão do template restaurada com sucesso.',
            ],
        ],
    ],

    'App\\Models\\PushQueue' => [
        'attributes' => [
            'player_id' => 'Player ID',
            'template' => 'Template',
            'account' => 'Conta',
            'options' => [
                'status' => [
                    'pending' => 'Pendente',
                    'sent' => 'Enviado',
                    'failed' => 'Falha',
                ]
            ]
        ],
        'actions' => [
            'label' => 'Pushes',
            'index' => 'Lista de Pushes',
            'create' => 'Criar Push',
            'edit' => 'Editar Push',
            'delete' => 'Excluir Push',
            'restore' => 'Restaurar Push',
        ],
    ],

    'App\\Models\\PushTemplate' => [
        'name' => 'Template push',
        'attributes' => [
            'subject' => 'Assunto',
            'content' => 'Conteúdo',
            'template_category_id' => 'Categoria',
            'template_category' => 'Categoria',
            'created_by_user_id' => 'Usuário que criou',
            'updated_by_user_id' => 'Usuário que atualizou',
            'role_ids' => 'Papéis',
            'template_classification_ids' => 'Classificação',
            'status' => 'Status',
            'module_ids' => 'Módulos',
            'model_type' => 'Modelo relacionado',
            'model_id' => 'Escolha o id de um objeto do modelo relacionado para preencher as variáveis utilizadas no push',
            'url' => 'Link',
        ],
        'actions' => [
            'label' => 'Template push',
            'index' => 'Lista de Templates Push',
            'create' => 'Criar template',
            'edit' => 'Editar template',
            'delete' => 'Excluir template',
            'restore' => 'Restaurar template',
            'success' => [
                'restoredVersion' => 'Versão do template restaurada com sucesso.',
            ],
        ],
    ],

    'App\\Models\\SmsMessageQueue' => [
        'attributes' => [
            'person' => 'Pessoa',
            'template' => 'Template',
            'options' => [
                'status' => [
                    'pending' => 'Pendente',
                    'sent' => 'Enviado',
                    'failed' => 'Falha',
                ]
            ]
        ],
        'actions' => [
            'label' => 'Mensagem SMS',
            'index' => 'Lista de Mensagens SMS',
            'create' => 'Criar Mensagem SMS',
            'edit' => 'Editar Mensagem SMS',
            'delete' => 'Excluir Mensagem SMS',
            'restore' => 'Restaurar Mensagem SMS',
        ],
    ],

    'App\\Models\\DocumentGenerated' => [
        'attributes' => [
            'account' => 'Conta',
            'template' => 'Template',
            'sent_at' => 'Enviado em',
            'read_at' => 'Lido em',
        ],
        'actions' => [
            'label' => 'Documentos',
            'index' => 'Lista de Documentos',
        ],
    ],

    'App\\Models\\DocumentTemplate' => [
        'name' => 'Template de documento',
        'attributes' => [
            'subject' => 'Título',
            'content' => 'Conteúdo',
            'template_category_id' => 'Categoria',
            'template_category' => 'Categoria',
            'document_template_type_id' => 'Tipo de documento',
            'created_by_user_id' => 'Usuário que criou',
            'updated_by_user_id' => 'Usuário que atualizou',
            'role_ids' => 'Papéis',
            'template_classification_ids' => 'Classificação',
            'status' => 'Status',
            'module_ids' => 'Módulos',
            'model_type' => 'Modelo relacionado',
            'model_id' => 'Escolha um id do modelo relacionado para preencher as variáveis utilizadas no documento',
        ],
        'actions' => [
            'label' => 'Template de documento',
            'index' => 'Lista de Templates de Documento',
            'create' => 'Criar template',
            'edit' => 'Editar template',
            'delete' => 'Excluir template',
            'restore' => 'Restaurar template',
            'success' => [
                'restoredVersion' => 'Versão do template restaurada com sucesso.',
            ],
        ],
    ],

    'App\\Models\\EmailTemplate' => [
        'name' => 'Template de email',
        'attributes' => [
            'subject' => 'Assunto',
            'preheader' => 'Pré-header',
            'content' => 'Conteúdo',
            'template_category_id' => 'Categoria',
            'template_category' => 'Categoria',
            'created_by_user_id' => 'Usuário que criou',
            'updated_by_user_id' => 'Usuário que atualizou',
            'role_ids' => 'Papéis',
            'template_classification_ids' => 'Classificação',
            'status' => 'Status',
            'module_ids' => 'Módulos',
            'model_type' => 'Modelo relacionado',
            'emails' => 'E-mails para envio do teste',
            'model_id' => 'Escolha um id do modelo relacionado para preencher as variáveis utilizadas no email',
        ],
        'actions' => [
            'label' => 'Template de E-mail',
            'index' => 'Lista de Templates de E-mail',
            'create' => 'Criar template',
            'edit' => 'Editar template',
            'delete' => 'Excluir template',
            'restore' => 'Restaurar template',
            'success' => [
                'restoredVersion' => 'Versão do template restaurada com sucesso.',
            ],
        ],
    ],

    'App\\Models\\SmsTemplate' => [
        'attributes' => [
            'content' => 'Conteúdo',
            'template_category_id' => 'Categoria',
            'template_category' => 'Categoria',
            'created_by_user_id' => 'Usuário que criou',
            'updated_by_user_id' => 'Usuário que atualizou',
            'role_ids' => 'Papéis',
            'template_classification_ids' => 'Classificação',
            'status' => 'Status',
            'module_ids' => 'Módulos',
            'model_type' => 'Modelo relacionado',
            'phones' => 'Telefones para envio do teste',
            'model_id' => 'Escolha um id do modelo relacionado para preencher as variáveis utilizadas no email',
        ],
        'actions' => [
            'label' => 'Template de SMS',
            'index' => 'Lista de Templates de SMS',
            'create' => 'Criar template',
            'edit' => 'Editar template',
            'delete' => 'Excluir template',
            'restore' => 'Restaurar template',
            'success' => [
                'restoredVersion' => 'Versão do template restaurada com sucesso.',
            ],
        ],
    ],

    'App\\Models\\WhatsappMessageDespatched' => [
        'attributes' => [
            'person' => 'Pessoa',
            'template' => 'Template',
            'sent_at' => 'Enviado em',
        ],
        'actions' => [
            'label' => 'Mensagem Whatsapp',
            'index' => 'Lista de Mensagens Whatsapp',
        ],
    ],

    'App\\Models\\WhatsappMessageQueue' => [
        'name' => 'Mensagem do Whatsapp',
        'attributes' => [
            'account' => 'Conta',
            'element_name' => 'Element name',
            'namespace' => 'Namespace',
            'person' => 'Pessoa',
            'sent_at' => 'Enviada em',
            'options' => [
                'status' => [
                    'pending' => 'Pendente',
                    'sent' => 'Enviado',
                    'failed' => 'Falha',
                ]
            ]
        ],
        'actions' => [
            'label' => 'Mensagens Whatsapp',
            'index' => 'Lista de Mensagens Whatsapp',
            'create' => 'Criar Mensagem Whatsapp',
            'edit' => 'Editar Mensagem Whatsapp',
            'delete' => 'Excluir Mensagem Whatsapp',
            'restore' => 'Restaurar Mensagem Whatsapp',
        ],
    ],

    'App\\Models\\WhatsappTemplate' => [
        'name' => 'Template de Whatsapp',
        'attributes' => [
            'content' => 'Conteúdo',
            'subject' => 'Título',
            'template_category_id' => 'Categoria',
            'template_category' => 'Categoria',
            'created_by_user_id' => 'Usuário que criou',
            'updated_by_user_id' => 'Usuário que atualizou',
            'role_ids' => 'Papéis',
            'template_classification_ids' => 'Classificação',
            'contract_interaction_type_id' => 'Tipo de interação',
            'status' => 'Status',
            'module_ids' => 'Módulos',
            'model_type' => 'Modelo relacionado',
            'phones' => 'Telefones para envio do teste',
            'model_id' => 'Escolha um id do modelo relacionado para preencher as variáveis utilizadas na mensagem do Whatsapp',
        ],
        'actions' => [
            'label' => 'Template de Whatsapp',
            'index' => 'Lista de Templates de Whatsapp',
            'create' => 'Criar template',
            'edit' => 'Editar template',
            'delete' => 'Excluir template',
            'restore' => 'Restaurar template',
            'success' => [
                'restoredVersion' => 'Versão do template restaurada com sucesso.',
            ],
        ],
    ],

    'App\\Models\\MailTemplate' => [
        'attributes' => [
            'folders' => 'Pastas de conteúdo',
            'full_html' => 'Html completo',
        ],
        'actions' => [
            'label' => 'Template de email',
            'index' => 'Lista de Template de email',
            'create' => 'Criar template',
            'edit' => 'Editar template',
            'delete' => 'Excluir template',
            'restore' => 'Restaurar template',
        ],
    ],

    'App\\Models\\ContractRenew' => [
        'actions' => [
            'label' => 'Renovações',
            'index' => 'Renovações',
            'create' => 'Criar Renovação',
            'edit' => 'Editar Renovação',
            'delete' => 'Excluir Renovação',
            'restore' => 'Restaurar Renovação',
        ],
    ],

    'App\\Models\\Setting' => [
        'attributes' => [
            'frontend' => [
                'recaptcha' => 'Habilitar Recaptcha',
                'whatsapp' => 'Número do Whatsapp',
                'banner' => 'Banner Lateral',
                'alert_period' => 'Período do alerta',
                'welcome_email_page' => 'Welcome E-mail page',
                'xpromo' => 'XPROMO',
                'contents_report_category' => 'Categoria',
                'welcome_mail' => 'Corpo do email de boas vindas',
                'default_quotes' => 'Cotações Padrão',
                'social_share_text' => 'Texto de compartilhamento nas Redes Sociais',
                'content_disclaimer_text' => 'Disclaimer de conteúdo',
            ],
            'checkout' => [
                'welcome_email_page' => 'Welcome E-mail page',
                'xpromo' => 'XPROMO',
                'list_code' => 'List Code',
                'thank_you_text' => 'Texto de agradecimento',
            ],
            'bank_transfer' => [
                'enabled' => 'Habilitar transferência bancária',
                'amount' => 'Valor mínimo para aceitar transferência',
            ],
            'pix' => [
                'enabled' => 'Habilitar Pix',
                'amount' => 'Valor mínimo para aceitar Pix',
            ],
            'paymee' => [
                'timeout' => 'Tempo limite (minutos)',
                'only_lifetime' => 'Apenas modalidades vitalícias',
                'description' => 'Descrição',
                'subscription_status_if_paid_after_timeout' => 'status da assinatura ao pagar após o limite',
            ],
            'seo' => [
                'gtm_id' => 'ID',
            ],
            'trial' => [
                'list_code' => 'List Code',
                'welcome_email_page' => 'Welcome E-mail page',
                'xpromo' => 'XPROMO',
            ],
            'credit' => [
                'enabled' => 'Habilitar email de créditos',
                'email_page' => 'E-mail page',
            ],
            'books' => [
                'enabled' => 'Habilitar emails de pedidos de livros',
                'confirmed_page' => 'Corpo do email de livros confirmados',
                'delivered_page' => 'Corpo do email de livros entregues',
                'returned_page' => 'Corpo do email de livros retornados',
                'code_updated_page' => 'Corpo do email de atualização do código de rastreio',
            ],
            'emails' => [
                'enabled' => 'Habilitar email de boas vindas para Modalidades e produtos',
                'last_contract' => 'Enviar último contrato',
                'updated_contract' => 'Enviar contrato atualizado',
                'accordingly' => 'De acordo',
                'payment_slip' => 'Enviar carnê',
                'invoice' => 'Enviar fatura',
                'password_reset' => 'Reset de senha',
            ],
            'leads' => [
                'indication_seller_id' => 'Id do vendedor para relacionar às indicações',
            ],
            'gamefication' => [
                'points_name' => 'Nome da moeda',
                'subscription_points' => 'Pontuação por nova compra',
                'renew_subscription_points' => 'Pontuação por renovação',
                'cancel_subscription_points' => 'Pontuação a perder por cancelamento',
                'exchange_subscription_points' => 'Pontuação a perder por troca',
                'expire_subscription_points' => 'Pontuação a perder por expiração',
                'read_contents_points' => 'Pontos ao ler conteúdos de destaque',
                'access_from_app' => 'Pontos ao acessar pelo aplicativo',
                'full_register_points' => 'Pontuação ao finalizar cadastro',
                'daily_access_points' => 'Pontução por acesso diário',
                'weekly_access_points' => 'Pontuação por acesso em 7 dias seguidos',
            ],
            'omni' => [
                'telegram_xpromo' => 'Xpromo do telegram',
                'sms_xpromo' => 'Xpromo do SMS',
                'push_xpromo' => 'Xpromo do push',
            ],
        ],
        'actions' => [
            'frontend' => 'Espaço do Assinante',
            'checkout' => 'Checkout',
            'trial' => 'Trial',
            'Features' => 'Funções',
            'settings' => 'Configurações',

        ],
    ],

    'App\\Models\\PushMessage' => [
        'attributes' => [
            'options' => [
                'status' => [
                    'created' => 'Novo',
                    'scheduled' => 'Agendado',
                    'failed' => 'Falha',
                    'success' => 'Sucesso',
                ],
                'recurrence' => [
                    'once' => 'Enviar uma vez',
                    'content_publishing' => 'Publicação conteúdo',
                ],
            ],
            'content_id' => 'Edição',
            'send_at' => 'Enviar em',
            'sent_at' => 'Enviado em',
            'hide_unpublished' => 'Esconder não publicados',
        ],
        'actions' => [
            'label' => 'Mensagens Push',
            'index' => 'Lista de Mensagens Push',
            'create' => 'Criar Mensagem Push',
            'edit' => 'Editar Mensagem Push',
            'delete' => 'Excluir Mensagem Push',
            'restore' => 'Restaurar Mensagem Push',
        ],
    ],


    'App\\Models\\Activity' => [
        'attributes' => [
            'causer' => 'Autor',
            'causer_id' => 'Autor',
            'object' => 'Objeto',
            'action' => 'Ação',
            'subject_type' => 'Objeto',
            'subject_id' => 'ID do Objeto',
            'to_and_from' => 'De Para',
            'instance' => 'Instância',
            'options' => [
                'subject_type' => [
                    'Conteúdos' => [
                        'App\Models\Author' => 'Autores',
                        'App\Models\Media' => 'Galeria',
                        'App\Models\Category' => 'Categorias',
                        'App\Models\Folder' => 'Pastas',
                        'App\Models\Subfolder' => 'Subpastas',
                        'App\Models\Content' => 'Conteúdos',
                        'App\Models\Page' => 'Páginas',
                    ],
                    'Cadastros' => [
                        'App\Models\Product' => 'Produtos',
                    ],
                    'Vendas' => [
                        'App\Models\Customer' => 'Clientes',
                    ],
                ],

                'action' => [
                    'Assinaturas' => [
                        'cancel_by_user' => 'Assinatura cancelada pelo cliente',
                        'cancel' => 'Assinatura cancelada',
                        'inactivate' => 'Assinatura desativada',
                        'reactivate' => 'Assinatura reativada',
                        'trade' => 'Assinatura trocada',
                        'change' => 'Assinatura alterada',
                    ],
                    'Conta' => [
                        'paid' => 'Fatura paga manualmente.',
                        'failed' => 'Pagamento de fatura rejeitado.',
                        'refunded' => 'Fatura estornada.',
                    ],
                    'Cliente' => [
                        'login_by_admin' => 'Login pelo admin.',
                        'access_created' => 'Acesso criado.',
                        'access_regenerated' => 'Acesso regerado.',
                        'access_deleted' => 'Acesso deletado.',
                    ],
                    'Exports' => [
                        'download' => 'Download',
                    ],
                    'Indicação' => [
                        'indication_accepted' => 'Aceite',
                        'indication_created' => 'Criação',
                        'indication_updated' => 'Atualização',
                        'indication_expired' => 'Expiração',
                        'indication_status_changed' => 'Alteração do status',
                        'indication_canceled' => 'Cancelamento',
                        'indication_mgm_level_updated' => 'Atualização do nível',
                    ],
                    'Recursos' => [
                        'created' => 'Recurso criado',
                        'updated' => 'Recurso atualizado',
                        'deleted' => 'Recurso apagado',
                        'restored' => 'Recurso restaurado',
                    ],

                ],
            ],
        ],
        'actions' => [
            'label' => 'Log de Atividades',
            'index' => 'Lista de atividades',
            'success' => [
                'daily_clear_api_logs' => 'Limpeza de logs realizada.',
            ],
        ],
    ],

    'App\\Models\\Partner' => [
        'name' => 'Parceiro',
        'attributes' => [
            'has_api' => 'Possui API ?',
            'partner_has_an_api' => 'Possui API ?',
            'people--first_name' => 'Nome social',
            'first_name' => 'Nome social',
            'people--person_profiles--person_profile_documents--formated_document' => 'CNPJ',
            'fantasy_name' => 'Nome Fantasia',
            'is_active' => 'Status',
            'partner_types_group' => 'Tipo de parceiro',
            'options' => [
                'partner_types' => [
                    'INTEGRATION' => 'Integração',
                    'SERVICE_PROVISION' => 'Agente',
                    'SERVICE_PROVIDER' => 'Prestador de Serviços',
                ],
            ],
        ],
        'actions' => [
            'label' => 'Parceiros',
            'index' => 'Lista de Parceiros',
            'save' => 'Salvar Parceiro',
            'edit' => 'Editar Parceiro',
            'create' => 'Criar Parceiro',
            'show' => 'Visualizar Parceiro',
            'success' => [
                'created' => 'Parceiro criado.',
                'updated' => 'Parceiro atualizado.',
                'deleted' => 'Parceiro apagado.',
                'restored' => 'Parceiro restaurado.',
            ],
        ],
    ],

    'App\\Models\\EpharmaBeneficiary' => [
        'attributes' => [
            'dependents--people--fullName' => 'Nome do beneficiário',
            'dependents--people--person_profiles--cpf' => 'Documento vinculado',
            'statusLabel' => 'Status',
            'isError' => 'Possui erro?',
            'inconsistencies' => 'Inconsistências (Erros)',
            'subscription' => 'Assinatura - Modalidade',
        ],
        'actions' => [
            'label' => 'Beneficiários Epharma',
            'index' => 'Lista de Beneficiários',
            'save' => 'Salvar Beneficiário',
            'edit' => 'Editar Beneficiário',
            'create' => 'Criar Beneficiário',
            'show' => 'Visualizar Beneficiário',
        ],
    ],

    'App\\Models\\Address' => [
        'name' => 'Endereço',
        'actions' => [
            'label' => 'Endereços',
            'index' => 'Lista de endereços',
            'save' => 'Salvar endereços',
            'edit' => 'Editar endereço',
            'create' => 'Criar endereço',
            'show' => 'Visualizar endereço',
        ],
    ],

    'App\\Models\\Dependent' => [
        'attributes' => [
            'people--first_name' => 'Primeiro nome do dependente',
        ],
        'actions' => [
            'label' => 'Dependentes',
            'index' => 'Lista de dependentes',
            'save' => 'Salvar dependente',
            'edit' => 'Editar dependente',
            'create' => 'Criar dependente',
            'show' => 'Visualizar dependente',
        ],
    ],

    'App\\Models\\DependentGroupPet' => [
        'actions' => [
            'label' => 'Pets',
            'index' => 'Lista de dependentes',
            'save' => 'Salvar dependente',
            'edit' => 'Editar dependente',
            'create' => 'Criar dependente',
            'show' => 'Visualizar dependente',
        ],
    ],

    'App\\Models\\Bank' => [
        'name' => 'Banco',
    ],

    'App\\Models\\BankData' => [
        'name' => 'Dados bancários',
        'actions' => [
            'label' => 'Dados bancários',
            'index' => 'Lista de dados bancários',
            'save' => 'Salvar dados bancários',
            'edit' => 'Editar dados bancários',
            'create' => 'Criar dados bancários',
            'show' => 'Visualizar dados bancários',
        ],
    ],

    'App\\Models\\PersonLogin' => [
        'actions' => [
            'label' => 'Login de pessoas',
            'index' => 'Lista de logins de pessoas',
            'save' => 'Salvar login de pessoa',
            'edit' => 'Editar login de pessoa',
            'create' => 'Criar login de pessoa',
            'show' => 'Visualizar login de pessoa',
        ],
    ],

    'App\\Models\\EmailType' => $generics['actions']['type']('Email'),

    'App\\Models\\AddressType' => array_merge(
        [
            'name' => 'Tipo de endereço',
        ],
        $generics['actions']['type']('Endereço')
    ),

    'App\\Models\\AddressType' => array_merge(
        [
            'name' => 'Motivo de cancelamento do contrato',
        ],
        $generics['actions']['type']('Motivo de cancelamento do contrato')
    ),

    'App\\Models\\PhoneType' => $generics['actions']['type']('Telefone'),

    'App\\Models\\CustomerStatus' => $generics['actions']['type']('Status do Cliente'),

    'App\\Models\\PaymentCompany' => $generics['actions']['generic']('Companhias de pagamento', 'Companhia de pagamento'),

    'App\\Models\\PaymentMethod' => $generics['actions']['generic']('Métodos de pagamento', 'Método de pagamento'),

    'App\\Models\\ContractStatus' => $generics['actions']['type']('Status do Contrato'),

    'App\\Models\\ContractOrigin' => $generics['actions']['type']('Origem do Contrato'),

    'App\\Models\\ContractReason' => $generics['actions']['type']('Motivos de Contratação'),

    'App\\Models\\Product' => [
        'name' => 'Produto',
        'attributes' => [
            'is_checkout' => 'Disponível para vendas',
            'installment_in_cycle' => 'Parcelamento em Ciclo',
            'type' => 'Tipo (Modalidade, Taxa ou Produto/Serviço)',
            'individual' => 'Individual',
            'quantity_to_buy' => 'Quantidade máxima para compra',
        ],
        'actions' => [
            'label' => 'Produtos e Taxas',
            'index' => 'Produtos e Taxas',
        ],
    ],

    'App\\Models\\DeathProduct' => [
        'name' => 'Produto de óbito',
        'attributes' => [
            'type' => 'Tipo (Produto ou Taxa)',
            'options' => [
                'type' => [
                    'product' => 'Produto',
                    'fee' => 'Taxa',
                ],
            ],
        ],
        'actions' => [
            'label' => 'Produtos e taxas de Óbito',
            'index' => 'Lista dos Produtos e Taxas de Óbito',
        ],
    ],

    'App\\Models\\ProductInstallment' => [
        'actions' => [
            'label' => 'Parcelamento de Produtos e Taxas',
            'index' => 'Lista das configurações de parcelamentos',
        ],
    ],

    'App\\Models\\Plan' => [
        'name' => 'Cobertura',
        'attributes' => [
            'billing_cycles' => 'Ciclos',
            'sells_limit' => 'Limites de Modalidades por contrato',
            'allow_deactivation' => 'Pode ser desativado',
            'allow_cancellation' => 'Pode ser cancelado',
            'enable_coupon' => 'Permite cupom',
            'enable_bonus' => 'Permite bonificação',
            'accept_dependent' => 'Aceita dependente',
            'accept_pet' => 'Aceita PET',
            'allow_quantity' => 'Aceita Quantidade',
            'checkout_bill_now' => 'Cobrar Agora no Checkout (Somente Cartão)',
            'cross_sell_plans' => 'Sugestão de contratação',
        ],
        'actions' => [
            'label' => 'Modalidades',
            'index' => 'Lista de Modalidades',
        ],
    ],

    'App\\Models\\PlanCategory' => [
        'name' => 'Categoria de Cobertura',
        'actions' => [
            'label' => 'Categoria de Cobertura',
            'index' => 'Lista da Categoria de Cobertura',
        ],
    ],

    'App\\Models\\PlanSubCategory' => [
        'attributes' => [
            'is_master' => 'Cobertura principal',
            'faq_link' => 'URL FAQ',
            'renewable' => 'Renovável com taxa',
            'waiting_periods' => 'Período de carência (em dias)',
            'waiting_period_start_date_rule_id' => 'Política de início de carência',
            'changeable_waiting_period' => 'Permite alteração de carência',
            'exchangeable_modality' => 'Permite aleração de modalidade',
            'accept_substitute' => 'Aceita substituto',
            'accept_assisted' => 'Aceita assistido',
            'document_template_id' => 'Documento (Contrato)',
            'export_nfs' => 'Emitir NFS',
        ],
        'actions' => [
            'label' => 'Cobertura',
            'index' => 'Lista de Coberturas',
        ],
    ],

    'App\\Models\\PlanProduct' => [
        'actions' => [
            'label' => 'Taxas de Modalidades',
            'index' => 'Lista das Taxas vinculadas à Modalidades',
        ],
    ],

    'App\\Models\\PlanInstallment' => [
        'actions' => [
            'label' => 'Parcelamento de Modalidades',
            'index' => 'Lista das configurações de parcelamentos',
        ],
    ],

    'App\\Models\\PlanRule' => [
        'attributes' => [
            'max_dependents' => 'Número máximo de dependentes',
            'max_dependent_age' => 'Número máximo de dependentes com a idade máxima',
            'max_seniors' => 'Número máximo de idosos na modalidade',
            'max_extra' => 'Número máximo de pessoas acima da regra (exceções)',
            'max_pet' => 'Número máximo de pets',
            'age_holder' => 'Idade máxima do titular',
            'age_spouse' => 'Idade máxima do cônjuge',
            'age_senior' => 'Idade máxima do idoso',
            'age_extra' => 'Idade máxima de pessoas que podem entrar na exceção',
            'confirming' => 'Confirmação ao atingir idosos e/ou exceções',
        ],
        'actions' => [
            'label' => 'Regra das modalidades',
            'index' => 'Lista das configurações de regras para o modalidade',
        ],
    ],

    'App\\Models\\PlanSubCategoryRelation' => [
        'attributes' => [
            'first_plan_sub_categories_id' => 'Cobertura principal',
            'second_plan_sub_categories_id' => 'Coberturas acessórios',
        ],
        'actions' => [
            'label' => 'Relacionamento de Coberturas',
            'index' => 'Lista dos relacionamentos de Coberturas',
        ],
    ],

    'App\\Models\\Cover' => [
        'actions' => [
            'label' => 'Coberturas',
            'index' => 'Lista das coberturas',
        ],
    ],

    'App\\Models\\PlanInStore' => [
        'attributes' => [
            'code' => 'Código',
            'name' => 'Nome',
            'description' => 'Descrição',
            'amount' => 'Preço',
            'img_path' => 'Imagem',
            'external_code' => 'Código externo',
            'type' => 'Tipo',
            'email_template_id' => 'Template de e-mail',
            'plan_id' => 'Modalidade',
            'options' => [
                'type' => [
                    'purchasable' => 'Comercializável',
                    'leadGenerator' => 'Gerador de leads',
                    'socialBenefit' => 'Benefício social',
                    'partnerProduct' => 'Produto de parceiro',
                ],
            ],
        ],
        'actions' => [
            'label' => 'Coberturas da loja',
            'index' => 'Lista de coberturas da loja',
        ],
    ],

    'App\\Models\\CoverCombo' => [
        'actions' => [
            'label' => 'Combos de coberturas',
            'index' => 'Lista de Combos de coberturas',
            'create' => 'Criar Combo de coberturas',
            'edit' => 'Editar Combo de coberturas',
            'delete' => 'Excluir Combo de coberturas',
            'restore' => 'Restaurar Combo de coberturas',
            'save' => 'Salvar',
            'success' => [
                'updated' => 'Combo de coberturas atualizado com sucesso!',
                'created' => 'Combo de coberturas criado com sucesso!',
                'deleted' => 'Combo de coberturas deletado com sucesso!',
            ],
        ],
    ],

    'App\\Models\\CoverCategory' => $generics['actions']['generic']('Categorias de coberturas', 'Categoria de coberturas'),

    'App\\Models\\PlanCoverCombo' => [
        'attributes' => [
            'plan_id' => 'Modalidade',
            'cover_combo_id' => 'Combo de coberturas',
        ],
        'actions' => [
            'label' => 'Combos das coberturas de modalidade',
            'index' => 'Lista de combos das coberturas de modalidades',
        ],
    ],

    'App\\Models\\PlanDiscountRelation' => [
        'attributes' => [
            'plan_id' => 'Modalidade',
            'plan_sub_categories_id' => 'Cobertura',
            'cycles' => 'Ciclos para desconto',
            'discount' => 'Desconto (%)',
        ],
        'actions' => [
            'label' => 'Relacionamento de Cross Selling',
            'index' => 'Lista de relacionamentos de cross selling',
        ],
    ],

    'App\\Models\\PlanException' => [
        'attributes' => [
            'plan_id' => 'Modalidade',
            'relationship_type_id' => 'Parentesco',
            'minimum_age' => 'Idade mínima',
            'maximum_age' => 'Idade máxima',
        ],
        'actions' => [
            'label' => 'Configuração das exceções de aceite',
            'index' => 'Lista de exceções de aceite',
        ],
    ],

    'App\\Models\\Person' => [
        'name' => 'Pessoa',
        'attributes' => [
            'name' => 'Nome',
            'users--name' => 'Usuário',
            'first_name' => 'Nome',
            'last_name' => 'Sobrenome',
            'fullName' => 'Nome completo',
            'person_profiles--occupation' => 'Profissão',
            'person_profiles--birth_date' => 'Data de nascimento',
            'person_profiles--rg' => 'RG',
            'person_profiles--cpf' => 'CPF',
        ],
        'actions' => [
            'label' => 'Pessoas',
            'index' => 'Lista de Pessoas',
            'save' => 'Salvar Pessoa',
            'edit' => 'Editar Pessoa',
            'create' => 'Criar Pessoa',
            'show' => 'Visualizar Pessoa',
            'success' => [
                'created' => 'Pessoa criada.',
                'updated' => 'Pessoa atualizada.',
                'deleted' => 'Pessoa apagada.',
                'restored' => 'Pessoa restaurada.',
            ],
        ],
    ],

    'App\\Models\\Subscription' => [
        'name' => 'Assinatura',
        'attributes' => [],
        'actions' => [
            'label' => 'Assinaturas',
            'success' => [
                'created' => 'Assinatura criada.',
                'updated' => 'Assinatura atualizada.',
                'deleted' => 'Assinatura apagada.',
                'restored' => 'Assinatura restaurada.',
                'canceled' => 'Cancelada',
            ],
        ],
    ],

    'App\\Models\\SubscriptionType' => [
        'attributes' => [
            'value' => 'Valor (em meses)',
        ],
        'actions' => [
            'label' => 'Tipos de assinaturas',
            'index' => 'Lista dos tipos de assinaturas (cobranças)',
        ],
    ],

    'App\\Models\\Spouse' => [
        'name' => 'Cônjuge',
    ],

    'App\\Models\\LegalSuspensionType' => [
        'attributes' => [
            'model' => 'Modelo de dados para ser usado',
            'route_sufix' => 'Sufixo da rota',
        ],
        'actions' => [
            'label' => 'Tipos de suspensão jurídica',
            'index' => 'Lista dos tipos de suspensão jurídica',
        ],
    ],

    'App\\Models\\LegalSuspensionStatus' => [
        'actions' => [
            'label' => 'Status de suspensão jurídica',
            'index' => 'Lista dos status de suspensão jurídica',
        ],
    ],

    'App\\Models\\LegalLevel' => [
        'actions' => [
            'label' => 'Fases jurídicos',
            'index' => 'Lista das fases jurídicos',
        ],
    ],

    'App\\Models\\LegalInvolved' => [
        'actions' => [
            'label' => 'Parte',
            'index' => 'Lista das partes',
        ],
    ],

    'App\\Models\\LitigationSituation' => [
        'actions' => [
            'label' => 'Situações de status contencioso',
            'index' => 'Lista das situações de status contencioso',
        ],
    ],

    'App\\Models\\LegalSuspensionInteractionStatus' => [
        'attributes' => [
            'legal_suspension_types--name' => 'Tipo de suspensão jurídica',
        ],
        'actions' => [
            'label' => 'Status das interações de suspensão jurídica',
            'index' => 'Lista dos status das interações de suspensão jurídica',
        ],
    ],

    'App\\Models\\LegalSuspensionInteractionSubStatus' => [
        'attributes' => [
            'legal_suspension_interaction_statuses--name' => 'Status de interação da suspensão jurídica',
        ],
        'actions' => [
            'label' => 'Sub status das interações de suspensão jurídica',
            'index' => 'Lista dos sub status das interações de suspensão jurídica',
        ],
    ],

    'App\\Models\\LegalSuspensionInteractionChannel' => [
        'actions' => [
            'label' => 'Canais das interações de suspensão jurídica',
            'index' => 'Lista dos canais das interações de suspensão jurídica',
        ],
    ],


    'App\\Models\\Claim' => [
        'name' => 'Acionamento',
    ],

    'App\\Models\\ClaimInteractionStatus' => [
        'attributes' => [
            'claim_type_id' => 'Tipo de acionamento',
        ],
        'actions' => [
            'label' => 'Status das interações de acionamentos',
            'index' => 'Lista dos status das interações de acionamentos',
        ],
    ],

    'App\\Models\\ClaimInteractionSubStatus' => [
        'attributes' => [
            'claim_interaction_status_id' => 'Status da interação de acionamento',
        ],
        'actions' => [
            'label' => 'Sub status das interações de acionamentos',
            'index' => 'Lista dos sub status das interações de acionamentos',
        ],
    ],

    'App\\Models\\ClaimInteractionChannel' => [
        'actions' => [
            'label' => 'Canais das interações de acionamentos',
            'index' => 'Lista dos canais das interações de acionamentos',
        ],
    ],

    'App\\Models\\ClaimInteraction' => [
        'attributes' => [
            'claim_id' => 'Acionamento',
            'claim_interaction_status_id' => 'Status da interação',
            'user_id' => 'Usuário',
            'note' => 'Observação',
            'deadline' => 'Prazo',
        ],
        'actions' => [
            'label' => 'Interações de acionamentos',
            'index' => 'Lista de interações de acionamentos',
        ],
    ],

    'App\\Models\\ClaimInteractionHistory' => [
        'attributes' => [
            'claim_interaction_id' => 'Interação de acionamento',
            'claim_interaction_sub_status_id' => 'Sub status da interação',
            'claim_interaction_channel_id' => 'Canal da interação',
            'user_id' => 'Usuário',
            'deadline' => 'Prazo',
        ],
        'actions' => [
            'label' => 'Histórico de interações de acionamentos',
            'index' => 'Lista de histórico de interações de acionamentos',
        ],
    ],

    'App\\Models\\Claim' => [
        'actions' => [
            'label' => 'Acionamentos',
        ],
        'attributes' => [
            'customer--people--name' => 'Titular',
            'claimPerson--name' => 'Nome',
            'claimTypes-name' => 'Tipo',
            'claimPlans--partner--fantasy_name' => 'Parceiro',
            'claimReportPlans--partner--fantasy_name' => 'Parceiro',
            'claimStatus--name' => 'Status',
            'claimStatusTag--name' => 'Status',
            'claimSubStatus--name' => 'Substatus',
            'claimSubStatusTag--name' => 'Substatus',
            'created_at' => 'Data do acionamento',
        ],
    ],

    'App\\Models\\ClaimDocument' => [
        'actions' => [
            'label' => 'Documento de acionamentos',
        ],
    ],

    'App\\Models\\ClaimDocumentLink' => [
        'actions' => [
            'label' => 'Documento de acionamentos',
        ],
    ],

    'App\\Models\\SocialBenefitConsult' => [
        'attributes' => [
            'social_benefit_consult_type_id' => 'Tipo de consulta',
        ],
        'actions' => [
            'label' => 'Consultas de benefícios sociais',
        ],
    ],

    'App\\Models\\PostMortemConsultType' => [
        'attributes' => [
            'required_credits' => 'Usar Crédito',
            'lead_product' => 'Produto Lead'
        ],
        'actions' => [
            'label' => 'Consultas de benefícios sociais',
        ],
    ],

    'App\\Models\\Death' => [
        'name' => 'Óbito',
        'attributes' => [
            'responsible_person--first_name' => 'Primeiro nome do responsável',
            'city_of_funeral' => 'Cidade do funeral',
            'origin' => 'Origem',
            'destination' => 'Destino',
            'date' => 'Data',
        ],
        'actions' => [
            'label' => 'Óbitos',
        ],
    ],

    'App\\Models\\DeathPet' => [
        'actions' => [
            'label' => 'Óbitos de pets',
        ],
    ],

    'App\\Models\\ClaimType' => [
        'attributes' => [
            'model' => 'Modelo de dados para ser usado',
            'icon' => 'URL do ícone',
            'route_sufix' => 'Sufixo da rota',
        ],
        'actions' => [
            'label' => 'Tipos de acionamentos',
            'index' => 'Lista dos tipos de acionamentos',
        ],
    ],

    'App\\Models\\ClaimCancelStatus' => [
        'actions' => [
            'label' => 'Motivo de cancelamentos de acionamentos',
            'index' => 'Lista dos motivos de cancelamentos de acionamentos',
        ],
    ],

    'App\\Models\\ClaimStatus' => [
        'actions' => [
            'label' => 'Status de acionamentos',
            'index' => 'Lista de status de acionamentos',
        ],
    ],

    'App\\Models\\ClaimDocumentChecklist' => [
        'actions' => [
            'label' => 'Checklist de Documentos de Acionamento',
            'index' => 'Lista de Checklists de Documentos de Acionamento',
        ],
        'attributes' => [
            'subject_type_label' => 'Tipo de acionamento',
            'contract_document_type_ids' => 'Tipos de documentos de contrato',
            'claim_document_type_ids' => 'Tipos de documentos de acionamento',
        ],
    ],

    'App\\Models\\DeathServiceType' => [
        'actions' => [
            'label' => 'Tipos de serviços de funeral',
            'index' => 'Lista dos tipos de serviços de funeral',
        ],
    ],

    'App\\Models\\DeathCauseType' => [
        'actions' => [
            'label' => 'Tipos de causas de óbitos',
            'index' => 'Lista dos tipos de causas de óbitos',
        ],
    ],

    'App\\Models\\DeathPetCauseType' => [
        'actions' => [
            'label' => 'Tipos de causas de óbito de pets',
            'index' => 'Lista dos tipos de causas de óbito de pets',
        ],
    ],

    'App\\Models\\AssistanceType' => [
        'actions' => [
            'label' => 'Tipos de assistências',
            'index' => 'Lista dos tipos de assistências',
        ],
    ],

    'App\\Models\\SocialBenefitConsultType' => [
        'actions' => [
            'label' => 'Tipos de consultas de benefícios sociais',
            'index' => 'Lista dos tipos de consultas de benefícios sociais',
        ],
    ],

    'App\\Models\\ClaimPlan' => [
        'attributes' => [
            'id' =>  'ID',
            'served' => 'Atendido',
            'reason_for_non_attendance' => 'Motivo de não atendimento',
            'agency' => 'Agência',
            'death_type' => 'Tipo de óbito',
            'death_date' => 'Data do óbito',
            'origin_attendance' => 'Origem do atendimento',
            'assistence' => 'Assistência',
            'claim_plan_death_id' => 'ID do óbito',
            'claim_plan_contract_id' => 'ID do contrato',
            'claim_plan_death_person_name' => 'Nome do falecido',
            'claim_plan_death_cause' => 'Causa do óbito',
            'claim_plan_death_doco' => 'DO/CO',
            'claim_plan_partners' => 'Parceiro(s)',
            'death_on_waiting_period' => 'Morte em carência',
            'death_is_exception' => 'Exceção',
            'death_funeral' => 'Velório',
            'death_origin' => 'Origem',
            'destination' => 'Destino',
            'death_city' => 'Cidade',
            'death_state' => 'Estado',
            'death_funeral_city' => 'Cidade do Funeral',
            'claim_plan_contract_activeted_at' => 'Data de ativação do contrato',
            'death_pet_name' => 'Pet Falecido',
            'death_pet_cause' => 'Causa do óbito',
            'death_pet_on_waiting_period' => 'Morte em carência',
            'death_pet_origin' => 'Origem',
            'death_pet_destination' => 'Destino',
            'death_pet_city' => 'Cidade',
            'death_pet_date' => 'Data do óbito',
        ],
        'actions' => [
            'label' => 'Cupons',
            'index' => 'Lista de cupons',
        ],
    ],

    'App\\Models\\Coupon' => [
        'name' => 'Cupom',
        'attributes' => [
            'code' => 'CODE',
            'coupon_type' => 'Tipo de bônus',
            'amount' => 'Valor do bônus (se for modalidade deixar 0)',
            'plan_bonus' => 'Modalidade bonificada que será aplicado ao utilizar o cupom',
            'expiration_date' => 'Data de expiração',
            'quantity_available' => 'Quantidade disponível',
            'cycles' => 'Ciclos para uso (se for permanente deixar 0)',
            'plans_group' => 'Modalidades que podem usar o cupom',
            'is_app' => 'Cupom para APP',
            'description' => 'Descrição',
            'marketing_plans' => 'Planos Marketing'
        ],
        'actions' => [
            'label' => 'Cupons',
            'index' => 'Lista de cupons',
        ],
    ],

    'App\\Models\\Convalescence' => [
        'name' => 'Convalescência',
        'attributes' => [
            'name' => 'Nome',
            'equipments' => 'Equipamentos',
            'regulations' => 'Regulamentos',
            'type_of_company' => 'Tipo de Empresa',
            'service_area' => 'Zona de Atuação',
            'site' => 'Site',
            'main_phone' => 'Telefone Principal',
            'additional_phone' => 'Telefone Adicional',
            'avatar_path' => 'Avatar',
            'zip_code' => 'CEP',
            'number' => 'Número',
            'neighborhood' => 'Bairro',
            'complement' => 'Complemento',
            'street' => 'Rua',
            'city' => 'Cidade',
            'state' => 'Estado',
            'email' => 'E-mail',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
            'map_localization' => 'Localização no Mapa',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
            'deleted_at' => 'Deletado em',
        ],
        'actions' => [
            'label' => 'Convalescências',
            'index' => 'Lista de Convalescências',
            'create' => 'Criar Convalescência',
            'edit' => 'Editar Convalescência',
            'delete' => 'Excluir Convalescência',
            'show' => 'Ver Convalescência',
        ],
    ],


    'App\\Models\\SubscriptionCancellationType ' => [
        'actions' => [
            'label' => 'Tipos de cancelamentos de assinatura',
            'index' => 'Lista dos tipos de cancelamentos de assinatura',
        ],
    ],

    'App\\Models\\SubscriptionSubCancellationType ' => [
        'actions' => [
            'label' => 'Sub Tipos de cancelamentos de assinatura',
            'index' => 'Lista dos sub tipos de cancelamentos de assinatura',
        ],
    ],

    'App\\Models\\SubscriptionStatus' => [
        'actions' => [
            'label' => 'Status de assinaturas',
            'index' => 'Lista dos status de assinaturas',
        ],
    ],

    'App\\Models\\ContractProductStatus' => [
        'actions' => [
            'label' => 'Status do Produto/Taxa vinculada ao contrato',
            'index' => 'Lista dos status do Produto/Taxa vinculada ao contrato',
        ],
    ],

    'App\\Models\\ContractProduct' => [
        'name' => 'Produto de contrato',
        'actions' => [
            'label' => 'Produto de contrato',
            'index' => 'Lista dos Produtos de contrato',
        ],
    ],

    'App\\Models\\CustomerCard' => [
        'name' => 'Cartão de Crédito do Cliente',
        'attributes' => [
            'contract_id' => 'Contrato',
            'customer_card_type' => 'Tipo de cartão',
            'customer_card_status' => 'Status do cartão',
            'holder_name' => 'Nome do titular',
            'expiration_year' => 'Ano de expiração',
            'expiration_month' => 'Mês de expiração',
            'first_six' => 'Primeiros 6 dígitos',
            'last_four' => 'Últimos 4 dígitos',
            'brand' => 'Bandeira',
            'customer--person--first_name' => 'Primeiro nome do cliente',
            'add_new_card' => 'Link para adicionar novo cartão',
        ],
        'actions' => [
            'label' => 'Cartão',
        ],
    ],

    'App\\Models\\DependentFollowup' => [
        'name' => 'Acompanhamento de Dependente',
        'attributes' => [
            'id' => 'ID',
            'contract_id' => 'ID do Contrato',
            'dependent_id' => 'ID do Dependente',
            'requester_user_id' => 'ID do Usuário Solicitante',
            'decider_user_id' => 'ID do Usuário Decisor',
            'approved' => 'Aprovado',
            'pending' => 'Pendente',
            'has_fee' => 'Possui Taxa',
            'fee_id' => 'ID da Taxa',
            'request_at' => 'Data da Solicitação',
            'decided_at' => 'Data da Decisão',
            'obs' => 'Observações',
            'rule_obs' => 'Observações de Regras',
            'deleted_at' => 'Data de Exclusão',
            'created_at' => 'Data de Criação',
            'updated_at' => 'Data de Atualização',
        ],
    ],


    'App\\Models\\PersonProfile' => [
        'attributes' => [
            'birth_date' => 'Data de nascimento',
            'occupation' => 'Profissão',
            'marital_status' => 'Estado civil',
            'gender' => 'Gênero',

            'options' => [
                'genders' => [
                    'MALE' => 'Masculino',
                    'FEMALE' => 'Feminino',
                ],
                'marital_status' => [
                    'SINGLE' => 'Solteiro(a)',
                    'MARRIED' => 'Casado(a)',
                    'DIVORCED' => 'Divorciado(a)',
                    'WIDOWER' => 'Viúvo(a)',
                ],
            ]
        ],

    ],

    'App\\Models\\PersonProfileDocument' => [
        'attributes' => [
            'documents_group--document' => 'Documento',
            'options' => [
                'types' => [
                    'CPF' => 'CPF',
                    'RG' => 'RG',
                    'CNPJ' => 'CNPJ',
                    'RNI' => 'RNI',
                    'CIN' => 'CIN',
                    'RE' => 'RE'
                ]
            ]
        ]

    ],

    'App\\Models\\Module' => [
        'name' => 'Módulos',
        'attributes' => [
            'name' => 'Nome',
            'role_ids' => 'Papéis',
            'model_types' => 'Modelos relacionados',
            'created_by_user_id' => 'Usuário que criou',
            'updated_by_user_id' => 'Usuário que atualizou',
        ],
        'actions' => [
            'label' => 'Módulos',
            'index' => 'Lista de módulos',
            'save' => 'Salvar módulo',
            'edit' => 'Editar módulo',
            'create' => 'Criar módulo',
            'show' => 'Visualizar módulo',
            'success' => [
                'updated' => 'Módulo atualizado com sucesso!',
                'created' => 'Módulo criado com sucesso!',
            ],
        ],
    ],

    'App\\Models\\Variable' => [
        'name' => 'Variável',
        'attributes' => [
            'variable' => 'Variável',
            'model_type' => 'Modelo relacionado',
            'model_column' => 'Referência',
            'created_by_user_id' => 'Usuário que criou',
            'updated_by_user_id' => 'Usuário que atualizou',
            'status' => 'Status',
            'options' => [
                'status' => [
                    'active' => 'Ativo',
                    'inactive' => 'Inativo',
                ],
            ],
        ],
        'actions' => [
            'label' => 'Variáveis',
            'index' => 'Lista de variáveis',
            'save' => 'Salvar variável',
            'edit' => 'Editar variável',
            'create' => 'Criar variável',
            'show' => 'Visualizar variável',
            'success' => [
                'updated' => 'Variável atualizada com sucesso!',
                'created' => 'Variável criada com sucesso!',
                'deactivated' => 'Variável desativada com sucesso!',
                'activated' => 'Variável ativada com sucesso!',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Model Attributes
    |--------------------------------------------------------------------------
    */

    'default' => [
        'attributes' => [
            'financial_status' => 'Status financeiro',
            'products_ids' => 'Produtos',
            'plan_sub_categories_ids' => 'Coberturas',
            'start_date' => 'Data Início',
            'end_date' => 'Data Final',
            'variable_id' => 'Variável',
            'variable' => 'Variável',
            'model_type' => 'Modelo',
            'url_import_model' => 'URL do modelo de importação',
            'colorBadge' => 'Cor da Tag',
            'documents_group--document' => 'Documento',
            'first_name' => 'Nome',
            'last_name' => 'Sobrenome',
            'relationship_type_id' => 'Tipo de relacionamento',
            'holder_customer_id' => 'Cliente titular',
            'actions' => 'Ações',
            'active' => 'Ativo',
            'amount' => 'Valor',
            'short_url' => 'Url encurtada',
            'api_token' => 'Token',
            'attendance' => 'Atendimento',
            'blank' => '',
            'checkout' => 'Checkout',
            'city_select' => 'Cidade',
            'city' => 'Cidade',
            'client' => 'Cliente',
            'code' => 'Código',
            'color' => 'Cor',
            'complement' => 'Complemento',
            'coupon' => 'Cupom',
            'cover' => 'Capa',
            'model_has_roles--role_id' => 'Papel',
            'logo' => 'Logo',
            'full_description' => 'Descrição completa',
            'short_description' => 'Pequena descrição',
            'downloadable' => 'Disponível para download',
            'expiration_date' => 'Data de Expiração',
            'claim_type_id' => 'Tipo de acionamento',
            'claim_types--name' => 'Tipo de acionamento',
            'claim_interaction_statuses--name' => 'Status da interação',
            'claim_id' => 'Acionamento',
            'claim_interaction_status_id' => 'Status da interação',
            'created_at' => 'Data de Cadastro',
            'customer_id' => 'Cliente',
            'cvv' => 'Cód. Segurança',
            'cycle' => 'Ciclo',
            'date_info' => 'Data',
            'description' => 'Descrição',
            'discount_cycles' => 'Ciclos do desconto',
            'discount_type' => 'Tipo de desconto',
            'discount_value' => 'Valor do desconto',
            'value' => 'Valor',
            'installment_from' => 'Parcelas de',
            'installment_to' => 'Parcelas até',
            'discount' => 'Desconto / Bônus',
            'product_id' => 'Produto',
            'products' => 'Produtos',
            'fee' => 'Juros / Taxas',
            'entry_value' => 'Valor de entrada',
            'export_type' => 'Tipo de exportação',
            'internal_code' => 'Código interno',
            'document' => 'Documento',
            'email' => 'E-mail',
            'end_at' => 'Fim',
            'expire_at' => 'Expiração',
            'flag' => 'Bandeira',
            'holder' => 'Titular',
            'id' => 'ID',
            'is_active' => 'Apenas ativos',
            'javascript' => 'Javascript',
            'mobile' => 'Mobile',
            'name' => 'Nome',
            'neighborhood' => 'Bairro',
            'number' => 'Número',
            'observation' => 'Observação',
            'old_password' => 'Senha atual',
            'order' => 'Ordem',
            'password_confirmation' => 'Confirmação',
            'password' => 'Senha',
            'payment_gateway' => 'Provedor de pagamento',
            'payment_method' => 'Pagamento',
            'permissions' => 'Permissões',
            'phone' => 'Telefone',
            'ddd' => 'DDD',
            'plan_categories_id' => 'Categoria de Cobertura',
            'plan_sub_categories_id' => 'Cobertura',
            'plan_id' => 'Modalidade',
            'plans' => 'Modalidades',
            'price' => 'Preço',
            'processed' => 'Processado',
            'k2_business' => 'k2 Business',
            'product' => 'Produto',
            'properties' => 'Propriedades',
            'publication' => 'Publicação',
            'published_at' => 'Data de Publicação',
            'reason' => 'Razão',
            'recurrence' => 'Recorrência',
            'redirect_url' => 'URL de redirecionamento',
            'reference' => 'Referência',
            'refund_amount' => 'Estornado',
            'reports' => 'Relatórios',
            'requested_refund_at' => 'Data de solicitação do estorno',
            'renew_at' => 'Renovação',
            'response' => 'Resposta',
            'slug' => 'Slug',
            'start_at' => 'Início',
            'products' => 'Produtos',
            'item_type' => 'Tipo',
            'state' => 'Estado',
            'status' => 'Status',
            'street' => 'Logradouro',
            'style' => 'CSS',
            'subscription_id' => 'Assinatura',
            'subscriptions' => 'Assinaturas',
            'summary' => 'Resumo',
            'tags' => 'Tags',
            'template_categories--name' => 'Categoria',
            'thumb' => 'Thumbnail',
            'title' => 'Título',
            'total' => 'Total',
            'trial_days' => 'Dias grátis',
            'type' => 'Tipo',
            'unpublished_at' => 'Data de Despublicação',
            'url' => 'URL',
            'user' => 'Usuário',
            'xpromo' => 'XPROMO',
            'year' => 'Ano',
            'attachments' => 'Anexos',
            'zip_code' => 'CEP',
            'neighborhood' => 'Bairro',
            'products' => 'Produtos',
            'document_type' => 'Tipo de documento',
            'email_type_id' => 'Tipo de email',
            'phone_type_id' => 'Tipo de telefone',
            'address_type_id' => 'Tipo de endereço',
            'customer_status_id' => 'Status do cliente',
            'birth_date' => 'Data de nascimento',
            'occupation' => 'Profissão',
            'marital_status' => 'Estado civil',
            'gender' => 'Gênero',
            'addresses_group' => 'Endereços',
            'phones_group' => 'Telefones',
            'emails_group' => 'Emails',
            'documents_group' => 'Documentos',
            'plans_group' => 'Modalidades',
            'partners_group' => 'Parceiros',
            'checkouts' => 'Checkouts',
            'interval_count' => 'Intervalo',
            'covers_group' => "Coberturas",
            'cover_categories_group' => 'Categorias de coberturas',
            'segmentation_id' => 'Segmentação',
            'role_id' => 'Papel',
            'full_name' => 'Nome completo',
            'due_at' => 'Data de vencimento',
            'original_due_at' => 'Data de vencimento original',
            'payment_at' => 'Data de pagamento',
            'payment_day' => 'Dia de pagamento',
            'payment_method' => 'Método de pagamento',
            'payment_company' => 'Provedor de pagamento',
            'person_id' => 'Pessoa',
            'arroba' => 'Arroba',
            'cpf' => 'Documento CPF',
            'promotion_id' => 'Promoção',
            'phrase' => 'Frase',
            'lucky_number' => 'Numero da Sorte',
            'registration_at' => 'Data de Registro',
            'login_kheper' => 'Login Kheper',
            'options' => [
                'boolean' => [
                    0 => 'Não',
                    1 => 'Sim',
                ],
                'type' => [
                    'plan' => 'Modalidades',
                    'fee' => 'Taxas',
                    'product' => 'Produto/Serviço',
                ],
                'segmentation_type' => [
                    'LEGAL' => 'Jurídico',
                    'CONTRACT' => 'Contratos',
                ],
                'coupon_type' => [
                    'percent' => 'Porcentagem',
                    'real' => 'Valor real',
                    'plan' => 'Modalidade',
                ],
                'months' => [
                    1 => 'Janeiro',
                    2 => 'Fevereiro',
                    3 => 'Março',
                    4 => 'Abril',
                    5 => 'Maio',
                    6 => 'Junho',
                    7 => 'Julho',
                    8 => 'Agosto',
                    9 => 'Setembro',
                    10 => 'Outubro',
                    11 => 'Novembro',
                    12 => 'Dezembro',
                ],
                'state' => [
                    'AC' => 'AC',
                    'AL' => 'AL',
                    'AM' => 'AM',
                    'AP' => 'AP',
                    'BA' => 'BA',
                    'CE' => 'CE',
                    'DF' => 'DF',
                    'ES' => 'ES',
                    'GO' => 'GO',
                    'MA' => 'MA',
                    'MT' => 'MT',
                    'MS' => 'MS',
                    'MG' => 'MG',
                    'PA' => 'PA',
                    'PB' => 'PB',
                    'PE' => 'PE',
                    'PI' => 'PI',
                    'PR' => 'PR',
                    'RJ' => 'RJ',
                    'RN' => 'RN',
                    'RS' => 'RS',
                    'RO' => 'RO',
                    'RR' => 'RR',
                    'SC' => 'SC',
                    'SP' => 'SP',
                    'SE' => 'SE',
                    'TO' => 'TO',
                ],
                'payment_method' => [
                    'credit_card' => 'Cartão de Crédito',
                    'debit_card' => 'Cartão de Débito',
                    'bank_deposit' => 'Depósito',
                    'bank_transfer' => 'Transferência',
                    'pix' => 'Pix',
                    'credits' => 'Créditos',
                    'manual' => 'Manual',
                    'free' => 'Grátis',
                    'payment_profile' => 'Perfil de pagamento',
                ],
                'interval' => [
                    'month' => 'Mês',
                    'bimonthly' => 'Bimestral',
                    'quarterly' => 'Trimestral',
                    'semester' => 'Semestral',
                    'Yearly' => 'Anual',
                    'lifetime' => 'Vitalício',
                ],
                'interval_count' => [
                    1 => 'Mensal',
                    2 => 'Bimestral',
                    3 => 'Trimestral',
                    6 => 'Semestral',
                    12 => 'Anual',
                    24 => 'Bienal',
                ],
                'discount_type' => [
                    'amount' => 'Valor (R$)',
                    'percentage' => 'Porcentagem (%)',
                    'plan' => 'Modalidade',
                ],
                'months' => [
                    1 => 'Janeiro',
                    2 => 'Fevereiro',
                    3 => 'Março',
                    4 => 'Abril',
                    5 => 'Maio',
                    6 => 'Junho',
                    7 => 'Julho',
                    8 => 'Agosto',
                    9 => 'Setembro',
                    10 => 'Outubro',
                    11 => 'Novembro',
                    12 => 'Dezembro',
                ],
                'xpromo' => [
                    'attendance' => [
                        'actions' => [
                            'label' => 'Registros',
                            'index' => 'Lista de registros',
                            'show' => 'Visualizar registro',
                            'create' => 'Criar registro',
                            'edit' => 'Editar registro',
                            'delete' => 'Remover registro',
                            'restore' => 'Restaurar registro',
                            'save' => 'Salvar alterações',
                            'export' => 'Exportar',
                            'send_pre_sale' => 'Enviar todos Pré-venda',

                            'download_content' => [
                                'video' => 'Baixar conteúdo como Vídeo',
                                'document' => 'Baixar conteúdo como PDF',
                                'spreadsheet' => 'Baixar conteúdo como Planilha',
                                'audio' => 'Baixar conteúdo como Áudio',
                                'datatable' => 'Baixar conteúdo como Tabela de Dados',
                            ],

                            'confirmation' => [
                                'delete' => 'Tem certeza que deseja excluir este item?',
                                'restore' => 'Tem certeza que deseja restaurar este item?',
                            ],

                            'success' => [
                                'created' => 'Registro criado',
                                'updated' => 'Registro atualizado',
                                'deleted' => 'Registro apagado',
                                'restored' => 'Registro restaurado',
                                'download' => 'Download',
                            ],

                            'failed' => [
                                'created' => 'Falha ao criar registro',
                                'updated' => 'Falha ao atualizar registro',
                                'deleted' => 'Falha ao excluir registro',
                                'restored' => 'Falha ao restaurar registro',
                            ],
                        ],
                        'TSA' => 'Telesales - A',
                        'TSR' => 'Telesales - R',
                        'AT' => 'Atendimento',
                        'WAT' => 'WhatsApp',
                        'CHAT' => 'Chat Checkout',
                        'CHCP' => 'Chat Copy',
                        'WAVY' => 'WAVY',
                    ],
                    'recurrence' => [
                        'M' => 'Mensal',
                        'B' => 'Bimestral',
                        'Q' => 'Trimestral',
                        'S' => 'Semestral',
                        'A' => 'Anual',
                        'V' => 'Vitalício',
                    ],
                ],
            ],
        ],
        'actions' => [
            'label' => 'Registros',
            'index' => 'Lista de registros',
            'show' => 'Visualizar registro',
            'create' => 'Criar registro',
            'import' => 'Importar',
            'edit' => 'Editar registro',
            'delete' => 'Remover registro',
            'restore' => 'Restaurar registro',
            'save' => 'Salvar alterações',
            'export' => 'Exportar',
            'send_pre_sale' => 'Enviar todos Pré-venda',

            'download_content' => [
                'video' => 'Baixar conteúdo como Vídeo',
                'document' => 'Baixar conteúdo como PDF',
                'spreadsheet' => 'Baixar conteúdo como Planilha',
                'audio' => 'Baixar conteúdo como Áudio',
                'datatable' => 'Baixar conteúdo como Tabela de Dados',
            ],

            'confirmation' => [
                'delete' => 'Tem certeza que deseja excluir este item?',
                'restore' => 'Tem certeza que deseja restaurar este item?',
                'deactivate' => 'Tem certeza que deseja desativar este item?',
                'activate' => 'Tem certeza que deseja ativar este item?',
            ],

            'success' => [
                'created' => 'Registro criado',
                'updated' => 'Registro atualizado',
                'deleted' => 'Registro apagado',
                'restored' => 'Registro restaurado.',
                'download' => 'Download',
                'expired_indication' => 'Indicação expirada',
            ],

            'failed' => [
                'created' => 'Falha ao criar registro.',
                'updated' => 'Falha ao atualizar registro.',
                'deleted' => 'Falha ao excluir registro.',
                'restored' => 'Falha ao restaurar registro.',
                'deactivated' => 'Falha ao desativar registro.',
            ],
        ],
    ],
];
