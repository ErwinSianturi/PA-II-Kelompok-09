package models

import (
	"time"
)

// Education model to map with the database table
type Education struct {
	ID         uint      `json:"id"`
	Level      string    `json:"level" binding:"required"`  // Education level (e.g., SMA, D1, etc.)
	Institution string   `json:"institution" binding:"required"` // Name of the institution
	Major      string    `json:"major"` // Optional, Major/department of study
	CreatedAt  time.Time `json:"created_at"`
}
