using System;
namespace OPMStudent
{
    public class Question
    {
        public Question()
        {
        }

        private string title;
        private string text;
        private string hint;
        private string answer;
        private Guid id;
        private User Author;

        public string Title { get => title; set => title = value; }
        public string Text { get => text; set => text = value; }
        public string Hint { get => hint; set => hint = value; }
        public string Answer { get => answer; set => answer = value; }
    }
}
