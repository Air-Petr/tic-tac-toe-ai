# Tic-Tac-Toe AI

PHP AI for a tic-tac-toe game.

## Installation

```bash
composer require air-petr/tic-tac-toe-ai
```

## How To Use

`Player` and `Board` are main classes of this package. In general, you create a board, give it to an AI player and receive it back with a new mark. `placeMark` is a main function of `Player` instance.

```php
use AirPetr\TicTacToeAi\Player;
use AirPetr\TicTacToeAi\Board;

$board = new Board();
$player = new Player();

echo $board->toString(); // "_________"

$boardWithMove = $player->placeMark('X', $board);

echo $boardWithMove->toString(); // "__X______"
```

There are three difficulties of AI players: easy, normal and hard.
- Easy player does random moves. 
- Hard player is based on a minimax algorithm. He is unbeatable.
- Normal player is between hard and easy player. He doesn't give you an easy victory, but can be caught by fork. Just like an average human Tic-tac-toe player.

```php
$easyPlayer = Player::easy();
$normalPlayer = Player::normal();
$hardPlayer = Player::hard();
```

`Board` instance can be created from various data sources. Use `X` and `O` symbols for initialization:

```php
$board1 = Board::createByString('__X___O__');
echo $board1->toString(); // "__X___O__"

$board2 = Board::createByPlainArray(['_', '_', 'X', '_', '_', '_', 'O', '_', '_']);
echo $board2->toString(); // "__X___O__"

$board3 = Board::createByArrayTable([
    ['_', '_', 'X'],
    ['_', '_', '_'],
    ['O', '_', '_']
]);
echo $board3->toString(); // "__X___O__"
```

`Board` instance also can be converted to various representations:

```php
$board = Board::createByString('__X___O__');

$board->toString();
// "__X___O__"

$board->toPlainArray();
// ['_', '_', 'X', '_', '_', '_', 'O', '_', '_']

$board->toArrayTable();
// [['_', '_', 'X'], ['_', '_', '_'], ['O', '_', '_']]
```

## Demo

You can play with code in `demo` folder. Here's how you can run interactive game:

```bash
php demo/interactive_game.php
```

## Testing

There are some unit tests in `test` folder. Run tests by:

``` bash
composer test
```
