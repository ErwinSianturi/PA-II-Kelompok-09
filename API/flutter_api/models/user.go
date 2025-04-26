package models

import (
	"time"
)

type User struct {
	ID              uint       `gorm:"primaryKey" json:"id"`
	Name            string     `json:"name"`
	Email           string     `gorm:"unique" json:"email"`
	EmailVerifiedAt *time.Time `json:"email_verified_at"`
	Password        string     `json:"password"`
	RememberToken   *string    `json:"remember_token"`
	CreatedAt       time.Time  `json:"created_at"`
	UpdatedAt       time.Time  `json:"updated_at"`
}
