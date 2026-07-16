USE program_carparts;

ALTER TABLE users ADD COLUMN IF NOT EXISTS email_status VARCHAR(20) NOT NULL DEFAULT 'Pending' AFTER promotions;
ALTER TABLE users ADD COLUMN IF NOT EXISTS verification_token VARCHAR(64) NULL AFTER email_status;
ALTER TABLE users ADD COLUMN IF NOT EXISTS verification_expires_at DATETIME NULL AFTER verification_token;

UPDATE users
SET email_status = 'Confirmed'
WHERE verification_token IS NULL;
