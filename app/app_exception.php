<?php
class AppException extends Exception
{
}

class ValidationException extends AppException
{
}

class RecordNotFoundException extends AppException
{
}

class PageNotFoundException extends AppException
{
}

class DuplicateValueException extends AppException
{
}