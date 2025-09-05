<?php

namespace Enums;
/**
 * Authorized genre representation
 * 
 * This enumeration contains all genders authorizes in the application
 */
enum Gender: string {
    case MALE = 'male';
    case FEMALE = 'female';
    case OTHER = 'other';
}