# Data Dictionary

## Entity: Company

| Attribute | Type | Description | Required | Key |
|-----------|------|-------------|----------|-----|
| Id_Company | int | Company's unique identifier | Yes | PK |
| name_company | String | Company name | Yes | |

## Entity: User_

| Attribute | Type | Description | Required | Key |
|-----------|------|-------------|----------|-----|
| Id_User | int | User's unique identifier | Yes | PK |
| name_user | String | User name | Yes | |
| Id_Company | int | Reference to Company | Yes | FK |

## Entity: Bill

| Attribute | Type | Description | Required | Key |
|-----------|------|-------------|----------|-----|
| Id_Bill | int | Bill's unique identifier | Yes | PK |

## Entity: CertificationType

| Attribute | Type | Description | Required | Key |
|-----------|------|-------------|----------|-----|
| Id_CertificationType | int | Certification type's unique identifier | Yes | PK |

## Entity: AuditType

| Attribute | Type | Description | Required | Key |
|-----------|------|-------------|----------|-----|
| Id_AuditType | int | Audit type's unique identifier | Yes | PK |

## Entity: Category

| Attribute | Type | Description | Required | Key |
|-----------|------|-------------|----------|-----|
| Id_Category | int | Category's unique identifier | Yes | PK |
| name_category | String | Category name | Yes | |
| Id_Category_1 | int | Reference to parent Category (self-referencing) | No | FK |

## Entity: Tag

| Attribute | Type | Description | Required | Key |
|-----------|------|-------------|----------|-----|
| Id_Tag | int | Tag's unique identifier | Yes | PK |
| tag_name | String | Tag name | Yes | |

## Entity: AuditTask

| Attribute | Type | Description | Required | Key |
|-----------|------|-------------|----------|-----|
| Id_AuditTask | int | Audit task's unique identifier | Yes | PK |
| name_task | String | Task name | Yes | |
| description_task | String | Task description | Yes | |
| Id_AuditType | int | Reference to Audit Type | Yes | FK |

## Entity: Roles

| Attribute | Type | Description | Required | Key |
|-----------|------|-------------|----------|-----|
| Id_Roles | int | Role's unique identifier | Yes | PK |
| name_role | String | Role name | Yes | |

## Entity: Audit

| Attribute | Type | Description | Required | Key |
|-----------|------|-------------|----------|-----|
| Id_Audit | int | Audit's unique identifier | Yes | PK |
| status_audit | String | Audit status | Yes | |
| Id_AuditType | int | Reference to Audit Type | Yes | FK |
| Id_Bill | int | Reference to Bill | Yes | FK |
| Id_Company | int | Reference to Company | Yes | FK |

## Entity: Certification

| Attribute | Type | Description | Required | Key |
|-----------|------|-------------|----------|-----|
| Id_Certification | int | Certification's unique identifier | Yes | PK |
| certification_status | String | Certification status | Yes | |
| Id_CertificationType | int | Reference to Certification Type | Yes | FK |
| Id_Bill | int | Reference to Bill | Yes | FK |
| Id_User | int | Reference to User | Yes | FK |

## Entity: Document

| Attribute | Type | Description | Required | Key |
|-----------|------|-------------|----------|-----|
| Id_Document | int | Document's unique identifier | Yes | PK |
| path_document | String | Document file path | Yes | |
| Id_Category | int | Reference to Category | Yes | FK |

## Junction Table: has

| Attribute | Type | Description | Required | Key |
|-----------|------|-------------|----------|-----|
| Id_Document | int | Reference to Document | Yes | FK/PK |
| Id_Tag | int | Reference to Tag | Yes | FK/PK |

## Junction Table: observes

| Attribute | Type | Description | Required | Key |
|-----------|------|-------------|----------|-----|
| Id_Audit | int | Reference to Audit | Yes | FK/PK |
| Id_User | int | Reference to User | Yes | FK/PK |
| Id_AuditTask | int | Reference to Audit Task | Yes | FK/PK |
| observation | String | Observation details | Yes | |

## Junction Table: has_role

| Attribute | Type | Description | Required | Key |
|-----------|------|-------------|----------|-----|
| Id_User | int | Reference to User | Yes | FK/PK |
| Id_Roles | int | Reference to Roles | Yes | FK/PK |

## Junction Table: visible_by

| Attribute | Type | Description | Required | Key |
|-----------|------|-------------|----------|-----|
| Id_Document | int | Reference to Document | Yes | FK/PK |
| Id_Roles | int | Reference to Roles | Yes | FK/PK |
