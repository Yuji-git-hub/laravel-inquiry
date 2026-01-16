<?php

namespace App\Domains\AdminUser;

final readonly class Password
{
    private ?string $plainText;
    private string $hash;

    public function __construct(?string $plainText, ?string $hash)
    {
        $this->plainText = $plainText;
        $this->hash = $hash;
    }

    public function matchesPlainText(string $plainText): bool
    {
        return password_verify($plainText, $this->hash);
    }

    public function getPlainText(): ?string
    {
        return $this->plainText;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public static function fromPlainText(string $plainText): self
    {
        if(strlen($plainText) < 8) {
            throw new \InvalidArgumentException('パスワードは8文字以上である必要があります。');
        }

        return new self(
            password_hash($plainText, PASSWORD_BCRYPT)
        );
    }

    public static function fromHash(string $hash): self
    {
        return new self($hash);
    }
}