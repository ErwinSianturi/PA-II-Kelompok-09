package models

import (
	"time" 
	"gorm.io/gorm" 
)

type Profile struct {
    gorm.Model
    UserID      uint      `json:"user_id"`
    Name        string    `json:"name" gorm:"type:varchar(100);not null"`
    Email       string    `json:"email" gorm:"type:varchar(100);not null"`
    Address     string    `json:"address" gorm:"type:varchar(255);not null"`
    Job         string    `json:"job" gorm:"type:varchar(100);not null"`
    Birthdate   time.Time `json:"birthdate" gorm:"type:date;not null"`
    Photo       string    `json:"photo" gorm:"type:varchar(255)"`
}
