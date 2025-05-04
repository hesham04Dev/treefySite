## Translation page
 keys from projects enrolled in where verification less that verification no and lang in translator lang
```php

```
























## db
users(id, name, email, email_verified_at, password, points=0, is_banned=0, is_new_user=1, remember_token, created_at, updated_at, google_id, avatar)

translators(user_id, is_accepted=0, cv_path, desc, level=1, exp=0)

projects(id, user_id -> users.id, name, desc, points_per_word=1, verification_no=2, created_at, updated_at)

languages(id, code, name)

language_translator(translator_id -> translators.user_id, language_id -> languages.id)

project_translator(translator_id -> translators.user_id, project_id -> projects.id)

translation_keys(id, value, created_at, updated_at)

translations(id, key_id -> translation_keys.id, project_id -> projects.id, language_id -> languages.id, value, created_at, updated_at,active_translators,skipped)

verifications(id, translator_id -> translators.user_id, translation_id -> translations.id, is_correct, created_at, updated_at)

updated_translations(verification_id -> verifications.id, value, created_at, updated_at)

image_verifications(id, lang, path, key_no, project_id -> projects.id, created_at, updated_at)

sessions(id, user_id -> users.id, ip_address, user_agent, payload, last_activity)

password_reset_tokens(email, token, created_at)

jobs(id, queue, payload, attempts, reserved_at, available_at, created_at)

transaction:(debit_user_id , credit_user_id, amount, transaction_type_id)

